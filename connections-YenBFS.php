<?php

/** For the graph $graph the function getFam returns all neighbour nodes of every nodes listed in $personList.
 * If a neighbour was already visited in earlier step going from the same side it is ignored.
 * If it was visited from opposite side - this means that it is in the middle of the searched path
 * and the string containing appropriate info is returned. If no new neighbours are found the $step is returned.
 * The function is separated from YensNextPath for easier usage in case the graph is retrieved from database.
 * @param array $graph - graph in the form of list of neighbours of every node (array of arrays all indexed by ID)
 * @param array $personList - list of nodes the neighbours are to be found
 * @param int $step - search step number (either positive or negative)
 * @global; $visited - list of visited nodes (distance, prev node, relation to the prev)  note ; is intentional
 * @return string|array|int - string descr.the mid of path or the list of new neighbours or 0 if nothing found
 **/
function getFam (array $graph, array $personList, int $step)
{
    # get all parents, children and spouses of every people in $personList
    global $visited; # will be used to retrieve the path -- visited[nid]=(dist,vfrom,rel)
    $newNeighbours = [];
    foreach ($personList as $person):
        if (!isset($graph[$person])){echo"\n<br>error: ";print_r($graph);exit('no such person');}
        foreach ($graph[$person] as $nearID=>$rel): # neighbours of $person
            if (!isset($nearID)): echo "\n<br> ---- $person has no neighbours"; continue; endif;
            if (!isset($visited[$nearID])): # not visited yet - add it to $visited
                $visited[$nearID] = ['dist'=>$step, 'vfrom'=>$person, 'rel'=>$rel];
                $newNeighbours[] = $nearID;  # here is the list of new neighbours
            elseif ($visited[$nearID]['dist'] * $step < 0): # found!
                return $nearID.','.strval($step).','.$person.','.$rel;
            endif;
        endforeach;
    endforeach;
    return count($newNeighbours)==0 ? 0 : $newNeighbours;
} # end of getFam definition

/** biBFS consists of two separate searches: from $start (source), and from $target (destination).
 * Both searches are recorded by the same array $visited (indexed by ID) with
 * source starting at 1 and increasing and destination at -1 and decreasing. Each step of the search
 * adds the new people visited on that step (either + or -). Finding an entry of the
 * opposite sign means the search is concluded whereas if it is of the same sign it is discarded.
 * If no new people are found on either direction of the searches, it fails immediately, as it means that
 * an isolated part of the graph has been detected.
 * @param array $graph - graph is the list of neighbour IDs of every node
 * @param string $start - start node ID
 * @param string $target - target node ID
 * @param int $stepLimit - max number of search steps (pairs)
 * @return string|int $found: string (ID etc of the node visited from both sides)
 *   or int (no neighbour found in step $step) or int ($stepLimit reached)
 * @global; $visited - list of visited nodes (distance, prev node, relation to the prev)  !! ; is intentional
 **/
function biBFS (array $graph, string $start, string $target, int $stepLimit) # type not defined for backward compatibility
{
    global $visited; # $visited is gradually filled by getFam with neighbours of previously visited nodes
    # $graph (i.e., the graph) is only read via getFam()
    if ($start==$target): return $start.",0,".$target; endif;
    $visited = []; $visited[$start]['dist']=1; $visited[$target]['dist']=-1;
    $forthback[1] = [$start]; $forthback[-1] = [$target]; # recently visited forth and back (starting from $start and $target)
    $step=1;
    while (TRUE): # collect visited nodes until a visited from opposite side is found or no unvisited can be found
        $step++; if ($step>$stepLimit) return $stepLimit; # the result is of int type
        foreach ([1,-1] as $direction): # search forth and then back
            $result = getFam($graph, $forthback[$direction], $direction*$step); # find neighbours of last visited node
            if (is_array($result)): # new neighbours found
                $forthback[$direction] = $result;
            elseif (is_string($result)):
                return $result; # found from both sides (info is composed to string)
            elseif (is_int($result)): # could be just "else"
                return $step*$direction; # no neighbours - isolated graph nodes
            endif;
        endforeach; # the pair of steps was done (forth and back) - continue while-true
    endwhile;
} # end of biBFS definition

/** Reconstruct the path using info saved in $found and $visited.
 * Half of relationships are recorded in reverse thus have to be inverted
 * @param string $start
 * @param string $target
 * @param string $found
 * @return array - reconstructed path
 * @global array $visited
 **/
function constructPath (string $start, string $target, string $found): array
{
    global $visited;
    $expl = explode(',',$found);
    $step = $expl[1];
    $x = $step>0 ? 0 : 2; # start reconstruction forth or back
    $startBack  = $expl[$x];
    $startForth = $expl[2-$x];
    # if $step is positive go towards $target, if negative - towards $start
    $indi = $startBack;
    $path[0] = $indi;
    while ($indi!=$target): # ending half
        $indi = $visited[$indi]['vfrom'];
        $path[] = $indi;
    endwhile;
    $indi = $startForth;
    array_unshift($path,$indi);
    while ($indi!=$start): # first half
        $indi = $visited[$indi]['vfrom'];
        array_unshift($path,$indi);
    endwhile;
    return $path;
} # end of constructPath definition

/** just pack biBFS to leave it untouched in my GitHub */
function mjaBFS ($graph, $start, $finish, &$shortestpathfound) {
    global $maxL;
    if ($start==$finish) exit("\n<br>The same person selected as start and finish!");
    $encounter = biBFS($graph, $start, $finish, $maxL/2);
    if (is_string($encounter)):
        $shortestpathfound = constructPath($start,$finish,$encounter);
        return TRUE;
    elseif (is_int($encounter)):
        return FALSE;
    endif;
    return NULL; # not needed! (just avoiding IDE notice)
} # end of mjaBFS definition

/** weight of a path where filiation is 1 and coition is SPOUSEDIST >1
 * @param array $path
 * @return float
 **/
function weightof (array $path): float
{
    global $graph; # use the original graph (inside Yen's there is a local copy which is modified by the algorithm)
    $weight=count($path)-1;
    for ($i = 1; $i<count($path); $i++):
        if ($graph[$path[$i-1]][$path[$i]] == SPOUSE): $weight+=SPOUSEDIST; endif;
    endfor;
    return $weight;
}

/** In every call a next-shortest path is calculated. The Yen's algorithm calculates candidate paths
 *  by disabling consecutive graph nodes and outgoing edges that were used in the previous shortest
 *  path and the earlier candidates. Shortest of the candidates is selected as the next shortest path.
 * @param array $graph - the graph
 * @param string $start - ID of start person (node)
 * @param string $finish - ID of end person (node)
 * @param &$kShortestPaths - table (reference!) of shortest paths; the one just found will be added
 * @param int $lengthLimit - max path length allowed
 * @return bool - false if no more paths found
 **/
function YensNextPath (int $k, array $graph, string $start, string $finish, &$kShortestPaths, int $lengthLimit): bool
{
    static $candidatePaths = []; # candidates (remembered also from earlier calls)
    static $candidateWeights = []; # candidate weights stored in parallel to candidates
    if ($k == 1) # just find the shortest path
        if (mjaBFS($graph, $start, $finish, $kShortestPaths[$k])) return TRUE;
        else return FALSE; # means there is no connection
    # Searching for kth path while previous k-1 are already stored in $kShortestPaths.
    # k-1 th path nodes are taken one by one as $spurNode; preceding part is $rootPath.
    # Nodes of $rootPath are made inaccessible as well as links from $spurNode used in earlier paths
    $kthPath = $kShortestPaths[$k-1];
    $kthLength = count($kthPath);  # number of nodes, and not weight!
    # main loop through nodes of kth path becoming spurnodes
    for ($spurNum = 1; $spurNum < $kthLength; $spurNum++):
        $rootPath = array_slice($kthPath, 0, $spurNum); # initial $spurNum nodes
        $spurNode = $kthPath[$spurNum-1];
        # eliminate links of $spurNode that were used in any of the shortest paths beginning identical as the $rootPath
        foreach ($kShortestPaths as $testPath):
            if (array_slice($testPath, 0, $spurNum) == $rootPath):  # początki się pokrywają
                $spurLinkEnd = $testPath[$spurNum];
                unset($graph[$spurNode][$spurLinkEnd]); # eliminate link outgoing from $spurNode to $spurLinkEnd
                unset($graph[$spurLinkEnd][$spurNode]); # ...and coming from it
            endif;
        endforeach; # $spurNode used outgoing links removed
        # eliminate $rootPath node preceding $spurNode (previous nodes were eliminated earlier in the main loop)
        if (sizeof($rootPath)>1):
            $prevNode = $rootPath[$spurNum-2];  # numbering starts from 0
            if (isset($graph[$prevNode])):
                foreach ($graph[$prevNode] as $neighNode=>$rel):
					unset($graph[$prevNode][$neighNode]); # not necessary - $prevNode will be inaccessible
                    unset($graph[$neighNode][$prevNode]);
                    if (count($graph[$neighNode])==0): unset($graph[$neighNode]); endif; # niepotrzebnie!?
                endforeach;
                unset($graph[$prevNode]);
            endif;
        endif; # reduced graph crafted
        # now find the shortest path from $spurNode to $finish (if both still exist) in the reduced graph
        if (isset($graph[$spurNode]) && isset($graph[$finish])
            && mjaBFS($graph, $spurNode, $finish, $spurPath)):
            # merge to the $rootPath and update $candidatePaths
            $newcandPath = array_merge($rootPath, array_slice($spurPath, 1));
            if (count($newcandPath)>$lengthLimit) continue; # skip it (next candidates can be shorter!)
            # skip candidate if is duplicate 1) among shortest 2) among saved candidates
			if(in_array($newcandPath,$kShortestPaths)) continue; # continue the main "for" loop - take a next $spurNode
			if(in_array($newcandPath,$candidatePaths)) continue;
			$candidatePaths[] = $newcandPath;
			$candidateWeights[] = weightof($newcandPath); # use weights for fast comparison (in place of queue handling)
        endif;  # shortest from $spurNode checked (either successfully or not)
    endfor;  # end of main loop through nodes of the previous shortest path
    if (count($candidatePaths)>0):  # take the shortest candidate as the new shortest path
        $bestCandInd = array_search(min($candidateWeights),$candidateWeights);
        $bestCandidate = $candidatePaths[$bestCandInd];
        $kShortestPaths[$k] = $bestCandidate;
        unset($candidatePaths[$bestCandInd]);
		unset($candidateWeights[$bestCandInd]);
        return TRUE;
    else:
		return FALSE; # there are no next shortest paths
    endif;
}  # end of YensNextPath definition

function constructRelString (array $path, array $graph): string
{
    $relString = '';
    for ($person=1; $person<sizeof($path); $person++):
        $relString .= $graph[$path[$person-1]][$path[$person]];
    endfor;
    return $relString;
}

/** Detect if the new path differs significantly from earlier paths.
 *  There are 4 cases taken into account that make the path genealogically irrelevant. --case 1 improved 18.02.2022
 * @param int $k - last path number
 * @param array $allRelStrings - table of RelStrings arranged in the same order as in allPaths
 * @param array $allPaths - table of all paths found so far
 * @param array $graph - the graph of all peaple and their direct relations (filiantions and/or coitions)
 * @return bool - false if the $k'th path is ascertained relevant
 **/
function skipPath (int $k, array $allRelStrings, array $allPaths, array $graph, $echo = FALSE): bool
{
    $kthRelString = $allRelStrings[$k];

    # case 1: identical RelStrings; check them against all child1-parent-child2
    foreach ($allRelStrings as $i=>$ithRelStr): # loop through all RelStrings
        if ($ithRelStr==$kthRelString && $i<$k): # check if the last path has any duplicate
            $dupl = $i; # duplicate path No
            $from = 1; # start search from beginning (excl.x), then after an occurrence
            while ($pos=strpos('x'.$kthRelString, 'pc', $from)): # note: without 'x' $pos may be 0 which gives false!
                if ( $allPaths[$k][$pos] != $allPaths[$dupl][$pos] # not the same parent...
                      && $allPaths[$k][$pos-1] == $allPaths[$dupl][$pos-1] # ...of this child
                      && $allPaths[$k][$pos+1] == $allPaths[$dupl][$pos+1] ): # ...and its sibling
                    if ($echo) echo "k=$k same as i=$i relStr=$kthRelString pos=$pos ch1:{$allPaths[$k][$pos-1]}
                        par1:{$allPaths[$k][$pos]} par2:{$allPaths[$dupl][$pos]} ch2:{$allPaths[$k][$pos+1]}<br>";
                    return true;
                endif;
                $from = $pos + 1;
            endwhile;
        endif;
    endforeach;

    # case2: check every child-parent occurrence
    if (substr_count($kthRelString,'cp') > 0):
        if ($echo) echo "(k=$k $kthRelString goes between parents via a child and not directly)\n<br>";
        return true;
    endif;

    #case 3: check every parent-spouse occurrence if it concerns both parents (and not another marriage of a parent
    if (substr_count($kthRelString,'ps') > 0):
        $from = 1; # start search from beginning (excl.x), then after an occurrence
        while ($pos=strpos('x'.$kthRelString, 'ps', $from)): # note: without 'x' $pos may be 0 which gives false!
            if (isset($graph[$allPaths[$k][$pos-1]][$allPaths[$k][$pos+1]])):
                if ($echo) echo "($k th = $kthRelString goes to a parent via the other parent and not directly)\n<br>";
                return true;
            endif;
            $from = $pos + 1;
        endwhile;
    endif;

    # case 4: check every spouse-child occurrence if it concerns child of both parents (and not other marriage of a parent)
    if (substr_count($kthRelString,'sc') > 0):
        $from = 1; # start search from beginning (excl.x), then after an occurrence
        while ($pos=strpos('x'.$kthRelString, 'sc', $from)):
            if (isset($graph[$allPaths[$k][$pos-1]][$allPaths[$k][$pos+1]])):
                if ($echo) echo "($k th = $kthRelString goes to a child via the other parent and not directly)\n<br>";
                return true;
            endif;
            $from = $pos + 1;
        endwhile;
    endif;

    return false;
} # end of skipPath definition

/** For the graph $graph the function getParents returns all parents of every people listed in $personList.
 * If a parent was already visited in earlier step going from the same side it is ignored (rare case!)
 * If it was visited from opposite side - it is the common ancestor and the info string is returned.
 * If no new parents are found the $step is returned.
 * @param array $graph - graph in the form of list of neighbours of every node (array of arrays all indexed by ID)
 * @param array $personList - list of persons (IDs) the parents are to be found
 * @param int $step - search step number (either positive or negative)
 * @global; array $visited - list of visited persons (distance, prev person, relation to the prev)
 * @return string|array|int - string: ancestorID.step.prevID  - array: list of new parents  - 0 if nothing found
 **/
function getParents (array $graph, array $personList, int $step)
{
    # get all parents of every people in $personList
    global $visited; # will be used to retrieve the path -- visited[nid]=(dist,vfrom,rel)
    $newParents = [];
    foreach ($personList as $person):
        if (!isset($graph[$person])){echo"\n<br>error: ";print_r($graph);exit('no such person');}
        foreach ($graph[$person] as $nearID=>$rel): # neighbours of $person
            if (!isset($nearID)): echo "\n<br> ---- $person has no neighbours"; continue; endif;
            if ($rel==PARENT): # a neighbour is a parent
                if (!isset($visited[$nearID])): # not visited yet - add it to $visited
                    $visited[$nearID] = ['dist'=>$step, 'vfrom'=>$person, 'rel'=>$rel];
                    $newParents[] = $nearID;  # here is the list of new parents
                elseif ($visited[$nearID]['dist'] * $step < 0): # found! visited from opposite side
                    return $nearID.','.strval($step).','.$person;
                endif;
            endif; # is PARENT
        endforeach; # person's neighbours
    endforeach; # all persons from the list
    return count($newParents)==0 ? 0 : $newParents;
} # end of getParents definition

/** findCommonAncestor is based on biBFS and consists of two separate searches: from $start (source),
 * and from $target (destination). Results of the both are recorded by the same array $visited (indexed by ID) with
 * source starting at 1 and increasing and destination at -1 and decreasing. Each step of the search
 * adds the new people (parents) visited on that step (either + or -). Finding an entry of the same sign is discarded
 * whereas opposite sign means the search is concluded - the same ancestor is found starting from both sides.
 * If no new parents were found from any direction, it fails as it means that
 * the two persons have no common ancestor.
 * @param array $graph - graph is the list of lists of neighbour IDs of every node
 * @param string $start - start node ID
 * @param string $target - target node ID
 * @param int $stepLimit - max number of search steps (pairs)
 * @return string|int $found: string (ID etc of the node visited from both sides)
 *   or int (no neighbour found in step $step) or int ($stepLimit reached)
 * @global; array $visited - list of visited nodes (distance, prev node, relation to the prev)  !! ; is intentional due to WordPress
 **/
function findCommonAncestor (array $graph, string $start, string $target, int $stepLimit) # mixed return type declaration since PHP8
{
    global $visited; # $visited is gradually filled by getParents with parents of previously visited persons
    # $graph (i.e., the graph) is read via getParents() only
    if ($start==$target): return $start.",0,".$target; endif;
    $visited[$start]['dist']=1; $visited[$target]['dist']=-1;
    $forthback[1] = [$start]; $forthback[-1] = [$target]; # double array of persons recently visited forth and back (starting from $start and $target)
    $step=1; $moreAnc = [1,1];
    while (TRUE): # collect visited persons until a visited from opposite side is found or no unvisited can be found
        $step++; if ($step>$stepLimit) return $stepLimit; # the result is of int type
        foreach ([1,-1] as $direction): # search forth and then back
            $result = getParents($graph, $forthback[$direction], $direction*$step); # find parents of recently added persons
            if (is_array($result)): # new parents found
                $forthback[$direction] = $result;
            elseif (is_string($result)):
                return $result; # found from both sides - info is composed to string ancestorID.step.prevID
            elseif (is_int($result)): # no more parents found in step $step in direction $direction
                $moreAnc[$direction] = ''; # and continue opposite search direction if not yet done
            endif;
        endforeach; # the pair of steps was done (forth and back) - continue while-true
        if (!$moreAnc) return $step*$direction; # no common ancestor
    endwhile;
} # end of findCommonAncestor definition
