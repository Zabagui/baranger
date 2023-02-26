<?php
include("../../helplib.php");
echo help_header("Help: DNA Tests");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="reports_help.php" class="lightlink">&laquo; Help: Reports</a> &nbsp; | &nbsp;
			<a href="languages_help.php" class="lightlink">Help: Languages &raquo;</a>
		</p>
		<span class="largeheader">Help: DNA Tests</span>
		<p class="smaller menu">
			<a href="#search" class="lightlink">Search</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Add New</a> &nbsp; | &nbsp;
			<a href="#edit" class="lightlink">Edit Existing</a> &nbsp; | &nbsp;
			<a href="#ydna" class="lightlink">Y-DNA Fields</a> &nbsp; | &nbsp;
			<a href="#mtdna" class="lightlink">mtDNA Fields</a> &nbsp; | &nbsp;
			<a href="#atdna" class="lightlink">atDNA Fields</a> &nbsp; | &nbsp;
			<a href="#common" class="lightlink">Common Fields</a> &nbsp; | &nbsp;
			<a href="#delete" class="lightlink">Delete</a>
		</p>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">
		<div id="google_translate_element" style="float:right"></div><script type="text/javascript">
		function googleTranslateElementInit() {
		  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
		}
		</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

		<a name="search"><p class="subheadbold">Search</p></a>
        <p>Locate existing tests by searching for all or part of the <strong>Person ID</strong> or <strong>Name</strong>. Select a Tree or check one of the other options to further narrow your search.
		Searching with no options selected and no value in the search box will find all people in your database.</p>

		<p>Your search criteria for this page will be remembered until you click the <strong>Reset</strong> button, which restores all default values and searches again.</p>

		<span class="optionhead">Actions</span>
		<p>The Action buttons next to each search result allow you to edit, delete or preview that result. To delete more than one record at a time, click the box in the
		<strong>Select</strong> column for each record to be deleted, then click the "Delete Selected" button at the top of the list. Use the <strong>Select All</strong> or <strong>Clear All</strong>
		buttons to toggle all select boxes at once.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="add"><p class="subheadbold">Adding New Tests</p></a>
		<p>To add a new test, click on the <strong>Add New</strong> tab, then fill out the form. The test can be linked to people in the database after it has been saved.</p>
		<p>Note that fields can be left empty and will not be displayed in most cases.</p>

		<span class="optionhead">Test Type</span>
		<p>Select the type of DNA test this record refers to. (This is the only mandatory field)</p>

		<span class="optionhead">Test Number/Name</span>
		<p>Enter the ID number or name associated with this test. If you can't find a number or the vendor didn't give you one, feel free to make up a new number or name. <br /><strong>Note </strong> that if you do not enter a value for the Test Number/Name field, you will not have a quick link to edit the DNA data from DNA report screens such as browse_dna_tests.php.</p>
		
		<span class="optionhead">Vendor</span>
		<p>Enter the name of the company that supplied the test.</p>

		<span class="optionhead">Test Date</span>
		<p>This is the date the DNA test was taken if known.</p>

		<span class="optionhead">Match Date</span>
		<p>This is the date on which your test was matched to the person who took the DNA test.</p>

		<span class="optionhead">GEDmatch ID.</span>
		<p>The ID on GEDmatch web site for this test.  Applies to atDNA tests only.</p>

		<span class="optionhead">Keep Test Private.</span>
		<p>If you enter Yes to keep this test private, the test display will be restricted to logged in users who have the <strong>Allow Private</strong> privilege.  This allows you to restrict access to DNA Tests that you marked as Keep Test Private. The test will be viewable by the TNG Administrator</p>

		<span class="optionhead">Person who took this test</span>
		<p>This is the person who took the test. Select the tree and enter the person's ID, or click the magnifying glass to look up the individual by name. OR you can enter the name of a person not in your database. You must select a tree, even if the person is not in your database in order to resolve the Most Distant Ancestor and Most Common Recent Ancestor IDs.</p>
		
		<span class="optionhead">Keep Name Private</span>
		<p>If this box is checked, the name assigned for "Test Taker" will display as "Private" publicly. The name will be viewable to the TNG Administrator</p>
		
		<span class="optionhead">Add Test To A Group</span>
		<p>You can assign a test to a previously created DNA test group.<br />To create a DNA test group go to Admin >> DNA Tests >> and click on the DNA Groups tab. Then click on the Add New tab.</p>

		<span class="optionhead">DNA Groups</span>
		<p>DNA Groups are used to select or filter DNA tests or test_types in a list.  You should consider creating your DNA Groups in a meaningul way to restrict the list of tests displayed. For example, you might create a group for your paternal line and another group for your maternal line. DNA Groups are just a way to filter a list of tests. Linking tests to a group is optional.  Note that you DNA Groups are now associated to the test type and you cannot use the same DNA Group name for two different test types.</p>

		<span class="optionhead">Haplogroup</span>
		<p>A haplogroup is a genetic population of people who share a common ancestor on the patrilineal or matrilineal line. Haplogroups are assigned letters of the alphabet (A-T), and refinements (SNPs) consist of additional number and letter combinations. Two separate input fields are provided because some testing companies provide both as estimated haplogroups on atDNA tests or if the test taker also took the mtDNA or Y-DNA test.</p>
		<p>The <strong>mtDNA Haplogroup</strong> field is provided for the matrilineal haplogroup normally provided with the mtDNA test.</p>
		<p>The <strong>Y-DNA Haplogroup</strong> field is provided for the patrilineal line normally provided with the Y-DNA test.</p>
		<p>Some testing companies provide a mtDNA and Y-DNA Haplogroup on their atDNA tests.  Family Tree DNA provides it if the corresponding mtDNA and Y-DNA tests were taken. Other testing companies predict what the haplogroups might be.</p>

		<p>The confirmed checkbox is used to indicate that the test provided a confirmed haplogroup as opposed to a predicted one. Because a haplogroup consists of similar haplotypes, it is possible to predict a haplogroup from the haplotype. A SNP test is required to confirm the haplogroup prediction. Not all the testing companies offer SNP testing, and consequently their customer's haplogroup predictions are sometimes inaccurate.</p>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="ydna"><p class="subheadbold">Y-DNA Test Result Fields</p></a>
			
		<p>Your Y-chromosome DNA (Y-DNA) can trace your father, his father, his father’s father, and so forth using STR markers, which are places where your genetic code has a variable number of repeated parts.</p>
		<p><strong>Number of Markers</strong></p>
		<p>A genetic marker is a gene or DNA sequence with a known location on a chromosome that can be used to identify an individual. DNA tests can be distinguished by the number of markers they test for.<br />Typical Y-DNA tests can be done for 12, 25, 37, 44, 67, 91, 101 or 111 markers.<br />Because Family Tree DNA is currently the only vendor offering Y-DNA tests these days, 12, 25, 37, 67, and 111 markers are used in the Y-DNA comparison report.</p>
			
		<p><strong>Marker Values</strong></p>
		<p>Enter your Y-DNA marker values separated by commas.<br />For example, "13,24,14,10,11-14,12,12,12,13,14,30,17,9-10,11,11,24,15,19,30,15-15-16-17" (without quotes).<br />or with blanks after the comma for readability, "13, 24, 14, 10, 11-14, 12, 12, 12, 13, 14, 30, 17, 9-10, 11, 11, 24, 15, 19, 30,1 5-15-16-17" (without quotes).</p>
		<p>Note that Y-DNA STRs that have multiple values must be entered using a dash between the values since the number of multiple values can be variable</p>

		<strong>SNPs</strong></p>
		<p>An SNP (Single-nucleotide polymorphism) happens when a single place in the genome sequence is altered during the cell formation process and this mutation persists in the progeny. A person has many inherited SNPs that together create a unique (UEP) DNA pattern for that individual.</p>
        <p>In genetic genealogy a unique-event polymorphism (UEP) is a genetic marker that corresponds to a mutation which is likely to occur so infrequently that it is believed overwhelmingly probable that all the individuals who share the marker, worldwide, will have inherited it from the same common ancestor, and the same single mutation event.</p>

		<p><strong>Significant SNPs</strong></p>
		<p>These SNPs could be clinically related, American Indian related, etc.</p>

		<p><strong>Terminal SNP</strong></p>
		<p>A terminal SNP is the defining SNP of the latest branch of a haplogroup known by current research. It should be unique and constant in time. Sometimes “terminal SNP” is used to mean the SNP for which a man has most recently tested.</p>
		
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="mtdna"><p class="subheadbold">mtDNA Test Result Fields</p></a>
		
		<p><span class="optionhead">Mitochondrial DNA (mtDNA) </span> traces your ancestry from your mother to her mother, her mother's mother, and so forth and has two major parts, the control region and the coding region. The control region is often called the hypervariable region (HVR) and is further divided into two hypervariable regions
		<ul>
		<li><strong>HVR1</strong> which runs from nucleotide 16001 to nucleotide 16569. </li>
		<li><strong>HVR2</strong> which runs from nucleotide 00001 to nucleotide 00574. </li>
		<li>The <strong>coding region (CR)</strong> is the part of your mtDNA genome that contains genes which runs from nucleotide 00575 to nucleotide 16000.</li></ul></p>
		<p>The sbove information on mtDNA was extracted from the <a href="https://www.familytreedna.com/learn/mtdna-testing/parts-mitochondrial-dna-mtdna-hvr1-hvr2-coding-region/" target="_blank">The Family Tree DNA Learning Center</a></p>

		<p><strong>Reference Sequence</strong></p>
		<p> You can select one of two reference sequence for the mtDNA test result fields.  Family Tree DNA provides both sequence, so you need to chose which version of the results you are entering in the input fields.
		<ul><li><strong>RSRS</strong> - Reconstructed Sapiens Reference Sequence is a mitochondrial DNA (mtDNA) reference sequence that uses both a global sampling of modern human samples and samples from ancient hominids. It was introduced in early 2012 as a replacement for the rCRS (revised Cambridge Reference Sequence). The RSRS keeps the same numbering system as the CRS, but represents the ancestral genome of Mitochondrial Eve, from which all currently known human mitochondria descend.</li>
		
		<li><strong>rCRS</strong> - Revised Cambridge Reference Sequence for human mitochondrial DNA was first announced in 1981 leading to the initiation of the human genome project.</li></ul> </p>
			
		<p><span class="optionhead">HVR1/HVR2/Coding region Differences, Extra mutations</span></p>
		<p>Enter your mtDNA test results in the provided input fields separated by commas.<br />For example, "A16129G,T16187C,C16189T,T16223C,G16230A,T16278C,C16311T,C16519T".<br />You can also enter the results with a blank after the comma for increased reasability, for example "A16129G, T16187C, C16189T, T16223C, G16230A, T16278C, C16311T, C16519T" (without the quotes)</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="atdna"><p class="subheadbold">atDNA Test Result Fields</p></a>

		<p><span class="optionhead">Autosomal DNA (atDNA) </span> checks your autosomal chromosomes, that is the other 22 pairs beyond the sex-linked X and Y chromosomes. Autosomal DNA tests may help identify relatives who share recent ancestors. The more segments you share and the greater the length of those segments, the more closely related you are.</p>
		
		<p><strong>Shared DNA</strong><br />
		Shared DNA segments, also referred to as ‘matching segments’, are the sections of DNA that are identical between two individuals. These segments were most likely inherited from a common ancestor. When deciding which DNA matches to pursue, follow up on the ones with more than one large segment; those are your closer relatives, the ones whose trees may be easier to connect to yours.</p>
		
		<p><strong>Total shared cMs</strong><br />
		This is the sum of the autosomal DNA, given in centimorgans (cM), that you and your genetic match share.<br />See <a href="https://dnapainter.com/tools/sharedcmv4" traget="_blank">The Shared cM Project Tool</a> for the relationship probabilities based on the total shared cMs.</p> 
		
		<p><strong>shared segments</strong><br />
		Number of shared segments in this shared DNA match. The more segments you share and the greater the length of those segments, the more closely related you are.</p>
		
		<p><strong>Largest Segment</strong><br />
		Segments which share a large number of centiMorgans in common are more likely to be of significance and to indicate a common ancestor within a genealogical timeframe.  This is the largest shared seqment in this DNA match.</p>
		
		<p><strong>Chromosome No</strong><br />
		>This is the chromosome number of the largest matching segment.</p>
		
		<p><strong>Segment Start</strong><br />
		This is the starting location of the largest matching shared DNA segment</p>	
		
		<p><strong>Segment End</strong><br />
		This is the ending location of the largest matching shared DNA segment</p>
		
		<p><strong>centiMorgans</strong><br />
		In genetic genealogy, a centiMorgan (cM) or map unit (m.u.) is a unit of recombinant frequency which is used to measure genetic distance.  This is the number of cMs in the largest matching seqment.</p>
		
		<p><strong>Matching SNPs</strong><br />
		This is the number of SNPs for the largest matching segment,</p>
		
		<p><strong>X-Match</strong><br />
		This field indicates whether the autosomal DNA match also matches on the X-chromosome.</p>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="common"><p class="subheadbold">Common Test Result Fields</p></a>
		
		<p>The following fields are common to all test types>/p>

		<span class="optionhead">Most distant ancestor</span>
		<p>Enter the most distant paternal (Y-DNA) or maternal (mtDNA) ancestor's of the person taking the test.  Different Y-DNA and mtDNA testers might have different most distant ancestors depending on how far back they have taken their paper trail.</p>
		
		<span class="optionhead">Most recent common ancestor</span>
		<p>Enter the personID of the most recent common ancestor(MRCA). The MRCA is the shared common ancestor between two or more test takers.  The MRCA might be different depending where the lines meet between the test takers. </p>
		
		<span class="optionhead">Ancestral surnames</span>
		<p>This field applies to all test types and will be auto-filled with comma separated ancestral surnames of the person who took the Y-DNA and mtDNA tests only<br />The surnames returned depends on the test type and you may edit any way you like.<br />In Admin >> Setup >> Configuration >> General Settings>>Names there is an option for surname exclusion such as unknown or UNKNOWN and an option to display the surnames in uppercase.<br />There is now also an option for how many generations of your family tree the ancestral surnames will be returned for atDNA tests</p>

		<span class="optionhead">Notes</span>
		<p>Enter any notes associated with the test, or any other information you might have.</p>

		<span class="optionhead">Administrator notes</span>
		<p>The same as notes but only displayed for users with administrator rights.</p>

		<span class="optionhead">Relevant Links</span>
		<p>If there are web sites or pages associated with this test, enter them here. Put each link on a new line. Enter the site or page title and the URL, separated by a comma. For example, "Ancestry.com,https://www.ancestry.com". If you don't include the site or page title, the link itself will be used as the title.</p>
			
		<span class="optionhead">Media</span>
		<p>Here you can assign photos to a test by entering the mediaID of each photo.<br />Separate multiple entries with a comma. For example, "4361,5992"</p>
		
		<span class="optionhead">Test Information To Display</span>
		<p>Check the box next to any information you want displayed on a person's page (getperson.php).<br />All supplied info will be displayed on each test's page (show_dna_test.php).</p>

		<p>When you are finished, click the "Save" button to return to the list.</p>

		<p>For further information, please see the following pages on the TNG Wiki:</p>
		<ul>
			<li><a href="https://tng.lythgoes.net/wiki/index.php/DNA_Tests" target="_blank">DNA Tests<a></li>
			<li><a href="https://tng.lythgoes.net/wiki/index.php/TNG_and_DNA_Tests" target="_blank">TNG and DNA Tests<a></li>
			<li><a href="https://tng.lythgoes.net/wiki/index.php/DNA_Tests_Enhancements‎" target="_blank">DNA Tests Enhancements‎<a></li>
			<li><a href="https://tng.lythgoes.net/wiki/index.php/Compare_DNA_Test_Results‎" target="_blank">Compare DNA Test Results‎<a></li>
		</ul>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="edit"><p class="subheadbold">Editing Existing Tests</p></a>
		<p>To make changes to an existing test, use the <a href="#search">Search</a> tab to locate the test, then click on the Edit icon next to that test.</p>

		<span class="optionhead">Test Links</span>
		<p>You can link this test to individuals in your database. For each link, first select the tree associated with the link entity.
		Next, enter the ID number of the person to link then click on the "Add" button to create the link.</p>

		<p>If you don't know the ID number, click the magnifying glass icon to search for it. A popup window will appear to let you do the searching.
		When you find the desired individual, click the person's name to add their ID to the add box, then click the "Add" button as described above.</p>
		<p>The person taking the test is not automatically linked to the test.  You must create the link</p>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="delete"><p class="subheadbold">Deleting Existing Tests</p></a>
		<p>To delete a test, use the <a href="#search">Search</a> tab to locate the test, then click on the Delete icon next to that test. The row will
		change color and then vanish as the test is deleted. To delete more than one test at a time, check the box in the Select column next to each test to be
		deleted, then click the "Delete Selected" button at the top of the page.</p>

	</td>
</tr>

</table>
</body>
</html>