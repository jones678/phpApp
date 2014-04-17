<?
//\\isat-cit.marshall.edu\shj$
	class contact extends database
	{
	
		//constructor function
		public function __construct()
		{	
			database::__construct();
		}
		
		function printContact($ContactID)
		{
			$result = database::query("*","contact", "CID=" . $ContactID);
			$row = mysqli_fetch_array($result);
			
			echo "First Name: " . $row[CFName] . "</br>";
			echo "Last Name: " . $row[CLName] . "</br>";
			echo "Image Path: ";
				//If there is no image, go to default picture path
				if(!$row[CImage])
				{
					echo "There is no image</br>";
				}
				else //else if there is an image, show the appropriate image
				{
					echo "There is an image</br>";
				}
			
			echo "Group ID: ";
				//If there is a group ID, show what groups contact belongs to,
				if(!$row[GID])
				{
					echo "This contact doesn't have any groups</br>";
				}
				else
				{
					echo "This contact does have groups</br>";
				}
				//show capability to add client to group and/or create a new group for the client
			
			echo "Phone: ";
				//If there is a phone number, pull it from the query to the phone table
				//show capability to add another phone
			echo "E-mail: ";
				//If there is an e-mail, pull it from the query to the e-mail talbe
				//show capability to add another e-mail

				
		}
		
		//function to populate the contacts
		function populateContactsList($userID)
		{	
			echo "Contacts for User: " . $userID . "</br>";
			//query with select * from contacts where userID.. sort by CLName.
			$result = database::query("*","contact", "UID=" . $userID, "CLName");
						
			while ($row = mysqli_fetch_array($result))
			{	
				echo "This is the contact div start: <div class='contact'>";//start contact div
					
					echo "Contact: " . $row[CFName] . " " . $row[CLName] . "</br>";
					
				echo "This is the contact div ending:</div>";//end contact div
			}//end while for contact query
			echo "End of contacts for User: " . $userID;
		}

		

		
		
		function printPagination($numResultAll, $numResult, $page, $catID, $sort, $search, $prange, $rate)
		{			
			if ($numResultAll && $numResult && $page && $sort)
			{		
				echo "<ul class='pager'>";
					echo ($page==1 ? "" : " <li><a href='" . $_SERVER[PHP_SELF] . "?page=" . ($page-1) . ($catID ? "&amp;catID=" . $catID : "") . "&amp;sort=" . $sort . ($search ? "&amp;searchBox=" . $search : "") . ($prange ? "&amp;prange=" . $prange : "") . ($rate ? "&amp;rate=" . $rate : "") . "'>&laquo; Previous</a></li>");
					echo "<li> Page " . $page . " of " . ceil($numResultAll/PAGINATION) . " </li>";
					echo ($page != ceil($numResultAll/PAGINATION) ? "<li><a href='" . $_SERVER[PHP_SELF] . "?page=" . ($page+1) . ($catID ? "&amp;catID=" . $catID : "") . "&amp;sort=" . $sort . ($search ? "&amp;searchBox=" . $search : "") . ($prange ? "&amp;prange=" . $prange : "") . ($rate ? "&amp;rate=" . $rate : "") . "'>Next &raquo;</a></li>" : "");	
				echo "</ul>";
			}
			else
			{
				echo "There are no products that fall in this search.  Please try a different search.";
			}	
		}
		
		function printNumRecords($numResultAll, $numResult, $page)
		{			
			If ($page == 1)
			{
				echo "<div class='results'>Showing " . $page . " - " . ($numResult) . " of " . $numResultAll . " Results</div>";
			}
			else
			{
				//  showing 10-19 (page2) out of all of the results
				echo "<div class='results'><p>Showing " . (($page - 1)*PAGINATION + 1) . " - " . (($page-1)*PAGINATION+$numResult) . " of " . $numResultAll . " Results</p></div>";
			}
		}
		
		function printSort($catID, $page, $sort, $search, $prange, $sale)
		{
			echo "<div class='pull-right'>Sort by: ";
			//echo "Search string = " . $search;
			if(!$search)
			{
				//echo "<select name='order' onChange=\"window.location.search='&order='+this.value\">";
				echo "<select name='sort' onChange=\"window.location.search=" . "'catID=" . $catID . ($prange ? "&prange=" . $prange : "") . ($sale==Y ? "&sale=Y" : "") . "&page=" . $page . "&sort='+this.value\">";
			}
			else
			{
				echo "<select name='sort' onChange=\"window.location.search=" . "'searchBox=" . $search . ($prange ? "&prange=" . $prange : "") . ($sale==Y ? "&sale=Y" : "") . "&page=" . $page . "&sort='+this.value\">";
			}
			echo "<option value='pro_name' " . ($sort =='pro_name' ? "selected='selected'" : "") . ">Product Name</option>";
			echo "<option value='pro_price_up' " . ($sort =='pro_price_up' ? "selected='selected'" : "") . ">Price: Low to High</option>";
			echo "<option value='-pro_price' " . ($sort =='-pro_price' ? "selected='selected'" : "") . ">Price: High to Low</option>";
			echo "<option value='rate_up' " . ($sort =='rate_up' ? "selected='selected'" : "") . ">Rating: Low to High</option>";
			echo "<option value='rate_down' " . ($sort =='rate_down' ? "selected='selected'" : "") . ">Rating: High to Low</option>";
			
			echo "</select>";
						
			echo "</div>"; //end the sort div
		}
		
		function addVote($voted, $id)
		{
							//this is the code to process the voting (if it has been done)...
										 
					 //If the user has already voted on the particular thing, we do not allow them to vote again 	$cookie = "Mysite$id"; 
					 //commenting out cookie...
					/*	
						if(isset($_COOKIE[$cookie])) 
							{ 
							Echo "Sorry You have already ranked that site <p>"; 
							} 
					 
					 //Otherwise, we set a cooking telling us they have now voted 
						else 
							{ 
							$month = 2592000 + time(); 
							setcookie(Mysite.$id, Voted, $month); 
					*/
							//Then we update the voting information by adding 1 to the total votes and adding their vote (1,2,3,etc) to the total rating 
					database::create("REVIEW", "REV_ID, REV_RATING, PRO_ID, USER_ID","null, $voted, $id, null");
					echo "**Your vote has been cast**<br />";
					//("REVIEW","REV_ID, REV_RATING, PRO_ID, USER_ID","null,'3','1', null")
					//commenting out original:
					//mysql_query ("UPDATE vote SET total = total+$voted, votes = votes+1 WHERE id = $id"); 
					//		Echo "Your vote has been cast <p>"; 
					//		} 
					 
		}
	
		//deconstructor function
		public function __destruct()
		{
			database::__destruct();
		}
	
	}

?>