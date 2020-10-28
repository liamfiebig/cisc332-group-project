<?php
  include_once "inc/functions.php";
?>

<!DOCTYPE html>
<html lang="en">

<?php
  print_head("Adopt");
 ?>

<body>

  <?php
    require_once('inc/header.php');
  ?>

	<main>
        <h1>Adopt</h1>
        <section>
          <h2>Animals Rescued in 2018 </h2>
          <?php
            $dbh = new PDO('mysql:host=localhost;dbname=group26', "root", "");
            $statement = $dbh->query("SELECT count(A.IDnum) as numAnimals FROM animal A Where arrivesAt < '2019-01-01' and arrivesAt > '2017-12-31'");
            // assumption: assumptions: arrived at means when they were rescued,
            // the rescuers dropped them off the same day they were rescued at the SPCA
            $result = $statement->fetch();
            $adoptions = $result[0];
            if ($adoptions == 0){
              echo("No animals were adopted in 2018 by Rescue Organizations");
            }
            elseif($adoptions == 1){
              echo("1 animal was adopted in 2018 by Rescue Organizations ");
            }
            else {
              echo ("In 2018,  $adoptions animals were rescued by Rescue Organizations");
            }
            ?>
          <h2> Animals Available for Adoption</h2>
          <form id="<?= FILTER_BY ?>" action="adopt.php" method="post">
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
          // using checked = true, load all rows that are equal to value of checked
          // if all is checked, load all animals
    			$Location = NULL;
    			if(isset($_POST['Location'])) {
    				$Location = $_POST['Location'];
    			}

    			if($Location != NULL) {
    				if($Location != 'all') {
    					$rows = $dbh->query("SELECT IDnum , Name,
                  TYPE, Tracker,
                  arrivesAt, adoptedPaid
                  FROM animal
                  WHERE Tracker = '$Location' AND wasAdopted = 'FALSE'");
    					//if empty query, output that no animals are available for adoptions
    					if($rows->rowCount()) {
                ?>
                  <table>
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>ID Number</th>
                        <th>Species</th>
                        <th>Location</th>
                        <th>Date Arrived</th>
                        <th>Adoption Fee</th>
                      </tr>
                    </thead>
                <?php
    						foreach($rows as $row) {
                  ?>
                 <tbody>
                   <tr>
                     <td><?= $row[1]?></td>
                     <td><?= $row[0]?></td>
                     <td><?= $row[2]?></td>
                     <td><?= $row[3]?></td>
                     <td><?= $row[4]?></td>
                     <td><?= $row[5]?></td>
                   </tr>
                  <?php
    						}
                ?>
              </tbody>
             </table>
             <?php
    					}
              else {
    						echo "No animals available for adoption at this location!";
    					}
    				}
            else {	//user selected all organizations
    					$rows1 = $dbh->query("SELECT IDnum, Name,
                  TYPE, Tracker,
                  arrivesAt, adoptedPaid
                  FROM animal
                  WHERE wasAdopted = 'FALSE'");
    					//output donations to each individual organization
              if($rows1->rowCount()) {
                ?>
                  <table>
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>ID Number</th>
                        <th>Species</th>
                        <th>Location</th>
                        <th>Date Arrived</th>
                        <th>Adoption Fee</th>
                      </tr>
                    </thead>
                <?php
    						foreach($rows1 as $row) {?>
                  <tr>
                    <td><?= $row[1]?></td>
                    <td><?= $row[0]?></td>
                    <td><?= $row[2]?></td>
                    <td><?= $row[3]?></td>
                    <td><?= $row[4]?></td>
                    <td><?= $row[5]?></td>
                  </tr>
                  <?php
    						}
                ?>
              </tbody>
             </table>
             <?php
    					}
              else {
    						echo "No animals available for adoption at this time!";
    					}
    				}
    			}
          else {
    				echo 'Select an Organization'; //display this when user opens page for first time
    			}
    		?>
      </section>
  </main>
</body>
</html>
