<?php
/** $graph - the resulting graph i.e. array of all persons and their coitions and filiations
*   --$graph[x] is array of neighbors, each neighbor is array ID=>[rel,dist,prev]
 *  $namesDict - array of full names (ID=>name)
 *  $sexDict - array of genders (ID=>gender)
 **/
// #### "database" version (also exists: "gedcom" version ####

define('SPOUSE', 's');
define('PARENT', 'p');
define('CHILD', 'c');
define('SPOUSEDIST', 0.01);

# Build dictionary of people
$licznik = 0;
$graph = [];  // create dictionary, initially no neighbors
$namesDict = $sexDict = [];
$query = "SELECT personID, sex, title,firstname,prefix,lastname,suffix
            FROM $people_table
            WHERE gedcom = \"$tree\"";
//echo $query; die('1');
$result = tng_query($query);
$numrows = tng_num_rows($result);
//echo "\n<br>found $numrows persons in the $tree tree\n<br>"; die('2');
while ($row=tng_fetch_assoc($result)) {
//    print_r($row); echo "\n<br>"; if($row['sex']=="F") exit(3);
    $licznik+=1;
    $graph[$row['personID']] = [];  # dopisuje id z pustą tablicą krewnych
    $fullName = explode(" ", implode(" ",$row),3)[2];  # all but 2 fields
//    echo "\n<br> fullname = $fullName\n<br>";
    $namesDict[$row['personID']] = $fullName;
    $sexDict[$row['personID']] = $row['sex'];
//    if ($licznik==30) break;
}
tng_free_result($result);
//echo "graph init, dicts created"; die('3');
$marriages = []; #pusty słownik małżeństw (czasem jednoosobowych!) indeksowany familyID
$query = "SELECT familyID, husband,wife
           FROM $families_table
           WHERE gedcom = \"$tree\"";
$result = tng_query($query);
$numrows = tng_num_rows($result);
//echo "\n<hr>found $numrows families in the $tree tree\n<br>";
while ($row=tng_fetch_assoc($result)) {
    #słownik rodzin - wstawienie ID rodziców
    foreach (['husband','wife'] as $par) {
        if ($row[$par] !== '')
            $marriages[$row['familyID']][] = $row[$par]; // to avoid empty parent
//        else echo " empty family ={$row[$par]}";
    }
}
tng_free_result($result);
//echo "<br> marriages table:<br>"; print_r($marriages);
//echo "<br>F953 = "; print_r($marriages['F953']); exit();
//echo "<br>F001744 = "; print_r($marriages['F001744']); exit();

$children = []; # empty dict of childern indexed familyID
$query = "SELECT familyID,personID
            FROM $children_table
            WHERE gedcom = \"$tree\"";
$result = tng_query($query);
$numrows = tng_num_rows($result);
//echo "\n<br>found $numrows children in the $tree tree\n<br>";
while ($row=tng_fetch_assoc($result)) {
    $children[$row['familyID']][] = $row['personID'];
}
tng_free_result($result);
//echo "<br> children table:<br>"; print_r($children); die();
//echo "<br>F953 = "; print_r($children['F953']); exit();
//echo "<br>F001744 = "; print_r($children['F001744']); exit();

foreach ($marriages as $familyID => $parents) {
    if(sizeof($parents) == 2) {  // both parents exist - create 2x edge between them (cost>1)
        $graph[$parents[0]][$parents[1]] = SPOUSE;
        $graph[$parents[1]][$parents[0]] = SPOUSE;
//        print_r($parents);
    }
    if(empty($children[$familyID])) continue;
    if(sizeof($parents)>0) {
        foreach ($parents as $par) {
            foreach ($children[$familyID] as $chi) {  // for each child create 2x edge to every parent (cost=1)
                $graph[$par][$chi] = CHILD;
                $graph[$chi][$par] = PARENT;
    //            echo " par=$par--chi=$chi ";
            }
        }
    }
    else
        die("no parents in family=".$familyID);
}
//echo "<br> tablica People:<br>"; print_r($graph);
//echo "<br> sąsiedzi osoby I111: "; print_r($graph['I111']);
//echo "<br> sąsiedzi osoby I981: "; print_r($graph['I981']);
//echo "<br> sąsiedzi osoby I005494: "; print_r($graph['I005494']);
//die(1);
// nice print:
//$n=0;
//foreach($graph as $key=>$person) {
//    echo "<br>$key: ";
//    $n+=1;
//    foreach($person as $id=>$neigh) {
//        echo "-$id($neigh)-";
//    }
////    if($n>30) break;
//}
//exit("<br>\ngraph printed");
