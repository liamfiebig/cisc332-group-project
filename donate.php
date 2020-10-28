<?php
  include_once "inc/functions.php";
?>

<!DOCTYPE html>
<html lang="en">

<?php
  print_head("Donate");
 ?>

<body>

  <?php
    require_once('inc/header.php');
  ?>

	<main>
        <h1>Donate</h1>
        <h2> Donation Stats</h2>
        <form id="<?= FILTER_BY ?>" action="donate.php" method="post">
            <div>

            	<input type="radio" name="Location" for="Location" value="all" />
                <label for"all">All Organizations</label><br/>
                <input type="radio" name="Location" for="Location" value="rescue1" />
                <label for"rescue1">Rescue 1</label>
                <input type="radio" name="Location" for="Location" value="rescue2" />
                <label for"rescue2">Rescue 2</label>
                <input type="radio" name="Location" for="Location" value="rescue3" />
                <label for"rescue3">Rescue 3</label><br/>
                <input type="radio" name="Location" for="Location" value="shelter102" />
                <label for"shelter102">Shelter 102</label>
                <input type="radio" name="Location" for="Location" value="shelter103" />
                <label for"shelter103">Shelter 103</label>
                <input type="radio" name="Location" for="Location" value="shelter104" />
                <label for"shelter104">Shelter 104</label>
                <input type="radio" name="Location" for="Location" value="shelter106" />
                <label for"shelter106">Shelter 106</label>
                <input type="radio" name="Location" for="Location" value="shelter107" />
                <label for"shelter107">Shelter 107</label>
                <input type="radio" name="Location" for="Location" value="shelter108" />
                <label for"shelter108">Shelter 108</label><br/>
                <input type="radio" name="Location" for="Location" value="spca1" />
                <label for"spca1">SPCA 1</label>
                <input type="radio" name="Location" for="Location" value="spca2" />
                <label for"spca2">SPCA 2</label>
                <input type="radio" name="Location" for="Location" value="spca3" />
                <label for"spca3">SPCA 3</label><br/>

            </div>
            <input type="submit" value="Filter"/>
        </form>

		<?php
			$dbh = new PDO('mysql:host=localhost;dbname=group26', "root", "");
			$Location = NULL;
			if(isset($_POST['Location'])) {
				$Location = $_POST['Location'];
			}

			if($Location != NULL) {
				if($Location != 'all') {
					$rows = $dbh->query("SELECT amount FROM donations WHERE orgName = '$Location' and YEAR(date) = 2018");
					//if empty query, output that no donations were made in 2018
					if($rows->rowCount()) {
						foreach($rows as $row) {
							echo "Donations for $Location in 2018: $row[0].<br/>";
						}
					} else {
						echo "No donations were made to $Location in 2018.";
					}

				} else {	//user selected all organizations
					$rows1 = $dbh->query("SELECT orgName, amount FROM donations WHERE YEAR(date) = 2018");

					//output donations to each individual organization
					foreach($rows1 as $row) {
						echo "Donations for $row[0] in 2018: $row[1].<br/>";
					}

					//add all location amounts together for year 2018
					$sum = 0;
					$rows2 = $dbh->query("SELECT amount FROM donations WHERE YEAR(date) = 2018");
					foreach($rows2 as $row) {
						$sum += $row[0];
					}
					//output total sum of donations to all orgs in 2018
					echo "Total sum of donations to all oraganizations in 2018: $sum";

				}

			} else {
				echo 'Select an Organization'; //display this when user opens page for first time
			}
		?>

        <h2>
        Looking for a specific donor?
        </h2>
        <form id="<?= SEARCH_BOX ?>" action="donate.php" method="post">
			      <div>
				      <label for="<?= SEARCH_TERM_REQUIRED ?>"></label>
				      <input type="text" name="Donor" id="<?= SEARCH_TERM_REQUIRED ?>" placeholder="First Name and Last Name"  maxlength="100" required/>
			      </div>
			      <input type="submit" value="Search"/>
		</form>

		<?php
			if(isset($_POST['Donor'])) {
				$Donor = $_POST['Donor'];
				$fullName = explode(" ", $Donor);
				if(count($fullName) != 2) {		//check that correct name format is entered
					echo "Incorrect name format. Please enter the donor's first and last name.";
				} else {
					$fName = $fullName[0];
					$lName = $fullName[1];

					$result = $dbh->query("SELECT orgName, amount FROM donations WHERE fname = '$fName' and lname = '$lName'");

					//check if empty query
					if($result->rowCount()) {
						$donatedTo = array();	//array of orgs this donor has donated to
						$totalDonated = 0;
						foreach($result as $row) {
							//check if this org is in list of orgs donor has donated to.
							//if not, add this org to that list.
							if(!(in_array($row[0], $donatedTo))) {
								$donatedTo[] = $row[0];
							}
							//add to the sum donated
							$totalDonated += $row[1];
						}
						//display the organizations this donor has donated to
						echo "$fName $lName has donated to:<br>";
						foreach($donatedTo as $org) {
							echo "$org<br>";
						}
						echo "<br>";
						$string = "$fName $lName has donated \\$totalDonated over their lifetime.";
						$string = str_replace("\\", "$", $string);
						echo $string;
					} else {
						echo "$fName $lName is not a donor.";
					}
				}
			}

		?>


  </main>
</body>
</html>
