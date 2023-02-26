<?php
include("../../helplib.php");
echo help_header("Help: Media");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="more_help.php" class="lightlink">&laquo; Help: More</a> &nbsp; | &nbsp;
			<a href="collections_help.php" class="lightlink">Help: Collections &raquo;</a>
		</p>
		<span class="largeheader">Help: Media</span>
		<p class="smaller menu">
			<a href="#search" class="lightlink">Search</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Add</a> &nbsp; | &nbsp;
			<a href="#edit" class="lightlink">Edit</a> &nbsp; | &nbsp;
			<a href="#delete" class="lightlink">Delete</a> &nbsp; | &nbsp;
			<a href="#convert" class="lightlink">Convert</a> &nbsp; | &nbsp;
			<a href="#album" class="lightlink">Add to Album</a> &nbsp; | &nbsp;
			<a href="#sort" class="lightlink">Sort</a> &nbsp; | &nbsp;
			<a href="#thumbs" class="lightlink">Thumbnails</a> &nbsp; | &nbsp;
			<a href="#import" class="lightlink">Import</a> &nbsp; | &nbsp;
			<a href="#upload" class="lightlink">Upload</a>
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
        <p>Locate existing media by searching for all or part of the <strong>Media ID, Title, Description, Path</strong> or
		<strong>Body Text</strong>. Use the other available options to further narrow your search.
		Searching with no options selected and no value in the search box will find all media in your database. Search options include:</p>

		<span class="optionhead">Tree</span>
		<p>Restrict the results to media assigned to the selected tree.</p>

		<span class="optionhead">Collection</span>
		<p>Restrict the results to media of the selected Collection type. To add a new Collection, click on the "Add Collection" button, then fill out the form in
		the popup. You must create a folder for your new Collection, and you must create your own icon (or designate an existing one). The "Same setup as" field
		allows you to indicate which one of the basic Collection types your new Collection should emulate.</p>

		<span class="optionhead">File ext.</span>
		<p>Enter a file extension (e.g., "jpg" or "gif") prior to clicking the Search button to restrict the results to media with
		file names matching that extension.</p>

		<span class="optionhead">Unlinked only</span>
		<p>Check this box prior to clicking the Search button to restrict the results to media that are not linked to any individuals,
		families, sources, repositories or places.</p>

  		<span class="optionhead">Status</span>
		<p><strong>(Headstones only)</strong> Select a status from this list prior to clicking the Search button to show all headstone records with the same status.</p>

		<span class="optionhead">Cemetery</span>
		<p>Select a cemetery from this list prior to clicking the Search button to show all headstones assigned to the selected cemetery.</p>

		<p>Your search criteria for this page will be remembered until you click the <strong>Reset</strong> button, which restores all default values and searches again.</p>

		<span class="optionhead">Actions</span>
		<p>The Action buttons next to each search result allow you to edit, delete or preview that result. To delete more than one record at a time, click the box in the
		<strong>Select</strong> column for each record to be deleted, then click the "Delete Selected" button at the top of the list. Use the <strong>Select All</strong> or <strong>Clear All</strong>
		buttons to toggle all select boxes at once. You can also convert multiple items from one Collection to another, or add multiple items to an Album in the same
		manner (see below for more information).</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="add"><p class="subheadbold">Adding New Media</p></a>
		<p>To add new media, click on the <strong>Add New</strong> tab, then fill out the form. Some information, including the image map, location information, and
		links to people, families and other entities, can be added after saving or locking the record. Take note of the following:</p>

		<span class="optionhead">Collection</span>
		<p>Choose what type of media your item is (e.g., Photos, Documents, Headstones, Histories, Recordings or Videos). There is no restriction on file type	for any of these media <span class="emphasis">collections</span>.</p>

		<span class="optionhead">This media comes from an external source</span>
		<p>Check this box if this image resides somewhere on the Internet other than on your server. You must supply
		an absolute web address (for example, <em>https://www.thatsite.com/image.jpg</em>) in the field labeled "Media URL", and
		you must provide your own thumbnail if you wish to have one (TNG will not create one).</p>

		<span class="optionhead">Media File</span>
		<p>Select a physical file (either from your local computer or from your web site) for this media item.</p>

		<span class="optionhead">File to Upload</span>
		<p>If your new media item has not yet been uploaded to your web site, click the "Browse" button and locate it on your hard drive.
		If the item is already on your site, leave this field blank.</p>

		<span class="optionhead">File name on site / Media URL</span>
		<p>If you had previously uploaded your media item, enter the path and file name of your item as it exists within the corresponding collection folder on your web site,
		or click on the "Select" button to locate the file within the proper Collection folder. If you are uploading
		your media item now using the previous field, use this box to enter a path and file name for your file after it is uploaded. A suggested path and
		file name will be prepopulated for you. If you indicated this media comes from an external source, this field label will change to "Media URL",
		in which case you would enter the absolute URL .</p>

		<p><strong>NOTE</strong>: If you are uploading now, the directory you indicate here	must already exist and must be writeable by all. If not, use your FTP
		program or online file manager to create the directory and give it proper rights (775 should work, but 777 is required on some sites). </p>

		<span class="optionhead">OR Body Text</span>
		<p>Instead of uploading a physical file, you can type or paste the text or HTML code into this box. You can
		also use the controls at the top of the Body Text field to add formatting to your text. Hold your mouse pointer over the various control icons to see what you
		can do.</p>

		<p><strong>NOTE:</strong> If you are using HTML, do <strong>not</strong> include the HTML or BODY tags.</p>

		<span class="optionhead">Thumbnail Image File</span>
		<p>You can select an existing physical file (either from your local computer or from your web site) to act as a "thumbnail" (smaller image) for this media item,
		or you can have TNG create one for you. You can also allow TNG to use a default thumbnail image by not selecting either option. <strong>Notes:</strong>
		Ideally, thumbnails should be between 50 and 100 pixels on a side. Your thumbnail <strong>CANNOT</strong> be the same as the original image! TNG will complain if you attempt to use
		the original image as the thumbnail. If you do not already have a thumbnail, TNG can create one for you, but only if your media item is a valid JPG, GIF or PNG image.
		TNG can also create thumbnails from some PDF files, but you may still be required to upload your own thumbnail for others (especially older PDFs).</p>

		<span class="optionhead">Specify image/Create from original</span>
		<p>If your server supports the GD image library, you will see an option here to supply your own
		thumbnail or to have TNG create it for you from the original. If you choose the latter, by default the name of the new file will be the same as the original, with a prefix
		and/or suffix attached. This prefix and suffix, along with the max width and height of the thumbnail, are designated in the General Settings. <strong>Notes:</strong> Your
        thumbnail <strong>CANNOT</strong> be the same as the original image! TNG will complain if you attempt to use the original image as the thumbnail. TNG can only create a
		thumbnail for you if your media item is a valid JPG, GIF or PNG image (also some PDFs). PHP may complain if you ask to have a thumbnail created for an image that is very
		large (more than a Mb or so).</p>

		<span class="optionhead">File to Upload</span>
		<p>When an individual's genealogy is requested, thumbnail images of each photo linked to the individual are displayed on the same page. If a thumbnail
		image for your media item has not yet been uploaded to your web site, click the "Browse" button and locate the thumbnail on your hard drive.
		You must then enter the destination path and file name for the thumbnail image in the next field. If the thumbnail is already on your web site, leave this
		field blank.</p>

		<span class="optionhead">File name on site</span>
		<p>If you had previously uploaded your thumbnail image, enter the path and file name of your thumbnail as it exists within the corresponding collection folder
		on your web site (hint: you could put thumbnails in a subfolder if you want them to be kept separate or have the same names as the larger images). If you don't
		know the exact file name, you can click on the Select button to locate the file. If you are uploading your thumbnail now using the previous field, use this
		box to enter a path and file name for your thumbnail after it is uploaded. A suggested path and file name will be prepopulated for you.</p>

		<p><strong>NOTE</strong>: If you are uploading now, the directory you indicate here	must already exist and must be writeable by all. If not, use your FTP
		program or online file manager to create the directory and give it proper rights (775 should work, but 777 is required on some sites). </p>

		<span class="optionhead">Store files in: Multimedia Folder / Collection Folder</span>
		<p>You may choose to store this media item in a folder corresponding to the collection selected above (the default option), or you can put it in the general
		Multimedia folder.</p>

		<span class="optionhead">Title</span>
		<p>This should be short &#151; just a few words to identify your media item. It will be used as a link to the page displaying your item.</p>

		<span class="optionhead">Description</span>
		<p>Include more detail here if necessary, including information about who or what is pictured or described, etc. This will be displayed as a blurb
		accompanying your short description link (see previous field).</p>

		<span class="optionhead">Width, Height</span>
		<p><strong>(Videos only)</strong> Some video players (e.g., Quicktime) require that the width and height of the video be specified. If these are not specified, then the video may be cropped
		too tightly and some portions of the video will not be visible. It is therefore recommended that you enter the size of your video here in pixels. Please
		also remember to leave about 16 vertical pixels for the video controller (the play/stop/volume controls, etc.).</p>

		<span class="optionhead">Owner/Source, Date Taken</span>
		<p>These are optional. If you know this information, enter it in the appropriate areas.</p>

		<span class="optionhead">Tree</span>
		<p>If you would like to associate this media item with a particular tree, select that tree here. This will affect users who only have permissions to edit
		items associated with their assigned tree.</p>

		<span class="optionhead">Cemetery</span>
		<p>To associate this media item with a cemetery, select the cemetery from the dropdown box. Typically this is used with headstones to indicate where the headstone is located. You must first add the cemetery
		(under Admin/Cemeteries) before it will be visible in this box.</p>

		<span class="optionhead">Plot</span>
		<p><strong>(Headstones only)</strong> The plot where the headstone is located (optional).</p>

		<span class="optionhead">Status</span>
		<p><strong>(Headstones only)</strong> Select from the dropdown list the word or phrase that best describes the condition of the physical headstone in question.</p>

		<span class="optionhead">Always viewable</span>
		<p>Check this box if you want this media item to be displayed for the linked individuals at all times, regardless of their living status and user permissions.</p>

		<span class="optionhead">Open in new window</span>
		<p>To cause the item to open in a new window when its link is clicked, check this box.</p>

		<span class="optionhead">Private</span>
		<p>Check to hide this item unless the user has access to private data.</p>

		<span class="optionhead">Link this media directly to the selected cemetery</span>
		<p><strong>(Headstones only)</strong> Check this box to associate this headstone image with the cemetery itself. When the cemetery page is displayed, any media items
		associated with the cemetery in this manner will be displayed at the top of the page.</p>

		<span class="optionhead">Show cemetery map and media whenever this item is displayed</span>
		<p><strong>(Headstones only)</strong> If the cemetery where this headstone is located has an accompanying map or photo, check this box to display the map or photo as well whenever the
		headstone is displayed.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="edit"><p class="subheadbold">Editing Existing Media</p></a>
		<p>To make changes to existing media, use the <a href="#search">Search</a> tab to locate the item, then click on the Edit icon next to that item.
		 Take note of the following items that are not on the "Add New Media" page:</p>

		<span class="optionhead">Media Links</span>
		<p>You can link this media item to individuals, families, sources, repositories or places. For each link, first select the tree associated with the link entity.
		Next, select the Link Type (Person, Family, Source, Repository or Place), and finally, enter the ID number or name (Places only) of the link entity. After
		all the information has been entered, click on the "Add" button.</p>

		<p>If you don't know the ID number or exact Place Name, click the magnifying glass icon to search for it. A popup window will appear to let you do the searching.
		When you find the desired entity description, click the "Add" link at the left. You may click "Add" for multiple entities. When you are finished creating
		links, click on the "Close Window" link.</p>

		<p><strong>Existing Links:</strong> You may edit or delete an existing link by clicking on the Edit or Delete icon next to that link. Editing a link
		allows you to associate the link with a specific event and give it an <strong>Alternate Title</strong> and <strong>Alternate Description</strong>. You can
		also change the <strong>Default Photo</strong> or <strong>Show</strong> status for each link by checking the appropriate box. See below for more information on these attributes.</p>

		<p>Click the "Sort" link next to the Name to quickly jump to a page where you can sort similar media items for this entity. You can do the same thing by clicking on the
		Sort tab at the top of the Media pages, but this way is quicker.</p>

		<p><strong>WARNING</strong>: Links to specific events created within TNG may be overwritten by subsequent GEDCOM imports.</p>

		<span class="optionhead">Make Default</span>
		<p>Check this box to use the thumbnail for this media item on the pedigree chart and at the top of other pages related to the individual or entity to which
		the item is being linked.</p>

		<span class="optionhead">Show</span>
		<p>Uncheck this box if you don't want the thumbnail for this media item to show on the individual's page. You might choose to do this if the image was already
		part of an album that was linked to the same individual.</p>

		<span class="optionhead">Place Taken/Created</span>
		<p><p>This section will start out collapsed. To expand, click on the "Place Taken/Created" header, or the arrow next to it. If you know the name of the place
		where the photo was taken, enter it in the field labeled "Place Taken/Created".</p>

		<span class="optionhead">Latitude, Longitude</span>
		<p>If there are latitude and/or longitude coordinates associated with your media item, enter them here to help others more accurately pinpoint the location.
		Alternatively, you can use the Google Map geocode function above to set the latitude and longitude for the media location. Click on the "Show/hide clickable map"
		button to reveal the Google Map.</p>

		<span class="optionhead">Zoom</span>
		<p>Enter the zoom level or adjust the zoom controls on the Google Map above to set the zoom level. This option is only available if you have received a "key"
		from Google and entered it in your TNG Map Settings.</p>

		<p>Note: The Latitude/Longitude/Zoom information for media items is for informational purposes only. The location is not pinpointed on any map in the public area.</p>

		<span class="optionhead">Image Tags</span>
		<p>This section will start out collapsed. To expand, click on the "Image Tags" header, or the arrow next to it. This section allows you to link
		different portions of the image to individuals, families, sources, repositories or places in your database, or to external URLs.</p>

		<p><strong>Note</strong>: The media item must be a valid JPG, GIF or PNG image to use this feature.</p>

		<p>For each region you want to link, first select the tree and entity type (individual, family, etc), OR enter the title and external URL for another web page. 
		Then define the region by drawing a rectangle on the image with your
		mouse pointer. Start by clicking at the upper left corner of your rectangle, then hold down the mouse and move it down and to the right to draw the rectangle. When
		you get to the lower right corner of the rectangle, release the mouse. This will
		select your image coordinates. After the coordinates have been selected, a popup box will be displayed to allow you to find or enter the entity's ID. Enter
		all or part of the name or ID to locate possible matches, then choose the correct item from the candidates displayed. The
		box will close and a box for this region will be added on top of the image. To select an existing region, click on the box. You can then drag the box to move it, or click the "X"
		in the upper right corner to delete it.</p>

		<p>Repeat this process for any additional regions needed. All new code will be added to the end of that already in the Image Map box.</p>

		<p>To link different portions of your image to different pages, or to display short messages when the mouse pointer is over those portions, enter the needed
		image map code in this box. To construct your own image map, see the Image Map Construction section at the bottom of the page.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="delete"><p class="subheadbold">Deleting Media</p></a>
		<p>To delete one media item, use the <a href="#search">Search</a> tab to locate the item, then click on the Delete icon next to that item. The row will
		change color and then vanish as the item is deleted. To delete multiple media at a time, check the box in the Select column next to each item to be
		deleted, then click the "Delete Selected" button at the top of the page.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="convert"><p class="subheadbold">Converting Media From One Collection to Another</p></a>
		To convert media items from one media type or "Collection" to another, check the Select box next to those items on the <a href="#search">Search</a> tab,
		then select a new Collection from the dropdown box at the top of the page next to the "Convert Selected to" button. Finally, click the "Convert Selected to" button.
		The page will redisplay with a red status message at the top.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="album"><p class="subheadbold">Adding Media to Albums</p></a>
		To add media to an Album, check the Select box next to the items to be added, then select an Album from the dropdown box
		at the top of the page next to the "Add to Album" button. Finally, click the "Add to Album" button. Media can also be added to Albums from Admin/Albums.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="sort"><p class="subheadbold">Sorting Media</p></a>
		<p>By default, media linked to a Person, Family, Source, Repository or Place are sorted by the order in which they were linked to that entity. To change that
		order, you must indicate a new order on the Media/Sort tab.</p>

		<span class="optionhead">Tree, Link Type, Collection:</span>
		<p>Select the Tree associated with the entity for which you would like to sort media. Next, select a Link Type (Person, Family, Source, Repository or Place) and
		the Collection you would like to sort.</p>

		<span class="optionhead">ID:</span>
		<p>Enter the ID number or name (Places only) of the entity. If you don't know the ID number or exact place name, click the magnifying glass icon to search for it.
		When you find the desired entity, click on the "Select" link next to that entity. The popup will close and the selected ID will appear in the ID field.</p>

        <span class="optionhead">Link to specific event</span>
		<p>If you wish to sort only the media items attached to a specific event associated with the link entity, check the box marked "Link to specific event" AFTER
		all the other fields &mdash; including ID &mdash; are filled in. That will cause an additional dropdown box to appear, from which you will select the
		specific event (optional).</p>

		<span class="optionhead">Sorting Procedure</span>
		<p>After selecting or entering an ID, click on the "Continue" button to display all media for the selected entity and Collection in their current order.
		To re-order the items, click on the "Drag" area for any item and hold the mouse button down while moving the mouse pointer to the desired location
		within the list. When the item has reached the selected point, release the mouse button ("drag and drop"). Changes are automatically saved at that point.</p>
		
		<p>Another way to re-order the items is to enter a sequence number in the small box next to the "Drag" area, then click the "Go" link beneath the box or press Enter.
		This might be a good way to move items if the list is too long to all fit on the screen at once.</p>

		<p>You can also move any item directly to the top of the list by clicking on the double up arrow icon to the right of the "Drag" area.</p>

		<span class="optionhead">Default Photos</span>
		<p>While sorting, you may also select any of the displayed photos as the current entity's <strong>Default Photo</strong>. That means that the thumbnail for the
		selected image will appear on pedigree charts and in page titles with the current entity's name or title. To set or remove a Default Photo designation, hold
		your mouse pointer over any of the listed images, then click on either of the now visible options of "Make Default" or "Remove". The current Default Photo
		may also be removed by clicking on the "Remove Default" link at the top of the page.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="thumbs"><p class="subheadbold">Thumbnails</p></a>

		<span class="optionhead">Generate Thumbnails</span>
		<p>When you click on the "Generate" button under this option, TNG will automatically create thumbnails for all JPG, GIF or
		PNG images that do not already have an existing thumbnail. By default, the name of the new image will be the same as the larger image but with a
		prefix and/or suffix as defined by you in the General Settings. Check the box labeled "Regenerate existing thumbnails" to
		create thumbnails for all images, including those that already have them. Check "Regenerate thumbnail path names were file does not exist" if
		you think you have some thumbnail records that point to invalid files. That will cause TNG to reevaluate the thumbnail path names before regenerating
		the thumbnail. Without this feature, the same invalid thumbnail name would be regenerated over and over.</p>

		<p><strong>NOTE</strong>: If you do not see the Generate Thumbnails section, your server does not support the GD image library.</p>

		<span class="optionhead">Assign Default Photos</span>
		<p>This option allows you to make the first photo for each individual, family and source be that entity's Default
		Photo (the one displayed on pedigree charts, family group sheets, and at the top of other pages assigned to that entity). The assignment can be
		made for all individuals, families, sources and repositories in a particular tree by selecting that tree from the dropdown box. Check the box
		labeled "Override existing defaults" to set defaults regardless of what has previously been set. Leaving this box
		unchecked allows previously set defaults to remain.</p>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="import"><p class="subheadbold">Importing Media</p></a>

		<span class="optionhead">Purpose</span>
		<p>Create a media record for each physical file in any of your TNG media folders, with the file name becoming the title of each record.</p>

		<span class="optionhead">Usage</span>
		<p>To perform the import, first select a Collection (or add a new collection first) and a Tree (if the incoming items should be associated with a tree), then click the "Import"
		button. If a record	already exists for an item, no new record is created. The "key" (what determines whether a record already exists or not) consists of
		both the file name and the tree. If you import the same item into multiple trees (or if the item was once imported with "All Trees" and another time imported
		into a specific tree), TNG will not recognize that you already have a record for that item and it will create another.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="upload"><p class="subheadbold">Uploading Media</p></a>

		<span class="optionhead">Purpose</span>
		<p>Upload multiple media items at once, then give them better titles and descriptions, plus link them to individuals, families, sources or places
			directly from this screen.</p>

		<span class="optionhead">Usage</span>
		<p>To use, first select a Collection and a Tree (if the incoming items should be associated with a tree), then click "Add Files" and select one or more files from your computer to upload. Most browsers (not Internet Explorer) will also allow you to drag and drop files
			from another window directly into the white area in the middle of the screen. To select a subfolder within the selected media location as the destination
			for your files, enter the name in the "Folder" field, or use the "Select" button to choose a subfolder that already exists. If you don't need the files to
			be stored in a subfolder, then simply leave the Folder field blank.</p>
		<p>After selecting your files and the destination, you may begin the upload of all files together
			by clicking the "Start upload" button at the top of the page. Or, upload files individually by clicking the "Start" button next to those specific files.
			Once the upload has finished, you may add a new title or description, or link the item to entities in your database, or delete it altogether.</p>

		<span class="optionhead">Changing Title and Description</span>
		<p>After a file is uploaded, fields for Title and Description are displayed. To change the default values, type in the new information and click "Save" in
			the immediate area. Other information can be added later from the Edit Media screen.</p>

		<span class="optionhead">Add Links</span>
		<p>To link a particular media item to entities in your database, wait until the upload for that item has finished, then click the "Media Links" button on the same row.
			Enter the ID and click "Add", or use the Find option there to locate and select the ID.</p>
		<p>To link multiple media items to the same entity all at once, check the box on the row for each item (or use the "Select All" button to select all the
			uploaded items), then use the fields at the bottom of the page to complete the operation. Enter the ID, or use the Find icon to locate it. When the ID is in
			the ID field and at least one media item has been selected, click the "Link to selected" button to create the links.</p>
	</td>
</tr>

</table>
</body>
</html>