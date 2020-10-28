<?php
  include_once 'inc/functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<?php
  print_head("Volunteer");
 ?>

<body>

  <?php
    require_once('inc/header.php');
  ?>

	<main>
        <h1>Volunteer Today!</h1>
        <div>
          <h2>
            Who we are looking for?
          </h2>
          <blockquote>
            We are looking for hard workers who love animals. We have many roles to fill
            and want you to use your talents to help the animals of Queen's University.
            If you think you are the right fit for a role, please sign up below.
          </blockquote>
        </div>
        <form id="volunteer-form" method="post" action="volunteer.php">
            <div id= "name-row">
              <label for="<?= VOLUNTEER_FORM_FNAME ?>">First Name (required):</label>
                  <input type="text" name="<?= VOLUNTEER_FORM_FNAME ?>" id="<?= VOLUNTEER_FORM_FNAME ?>" maxlength="50" required/>
              <label for="<?= VOLUNTEER_FORM_LNAME ?>">Last Name (required):</label>
                  <input type="text" name="<?= VOLUNTEER_FORM_LNAME ?>" id="<?= VOLUNTEER_FORM_LNAME ?>" maxlength="50" required/>
            </div>
			      <div id="tel-row">
				         <label for="<?= VOLUNTEER_FORM_TEL ?>">Telephone (required):</label>
				             <input type="tel" name="<?= VOLUNTEER_FORM_TEL ?>" id="<?= VOLUNTEER_FORM_TEL ?>" maxlength="10" required/>
			      </div>
            <div id= "address-row">
              <label for="<?= VOLUNTEER_FORM_STREET ?>">Street(required):</label>
                  <input type="text" name="<?= VOLUNTEER_FORM_STREET ?>" id="<?= VOLUNTEER_FORM_STREET ?>" maxlength="50" required/>
              <br/>
              <label for="<?= VOLUNTEER_FORM_CITY ?>">City(required):</label>
                  <input type="text" name="<?= VOLUNTEER_FORM_CITY ?>" id="<?= VOLUNTEER_FORM_CITY ?>" maxlength="50" required/>
              <br/>
              <label for="<?= VOLUNTEER_FORM_PROVINCE ?>">Province(required):</label>
                  <input type="text" name="<?= VOLUNTEER_FORM_PROVINCE?>" id="<?= VOLUNTEER_FORM_PROVINCE ?>" maxlength="25" required/>
              <br/>
              <label for="<?= VOLUNTEER_FORM_POSTAL ?>">Postal Code (required):</label>
                  <input type="text" name="<?= VOLUNTEER_FORM_POSTAL ?>" id="<?= VOLUNTEER_FORM_POSTAL ?>" maxlength="7" required/>
            </div>
			      <div id="roles-row">
              <label for="<?= VOLUNTEER_FORM_WORKPLACE?>">Where would you like to volunteer? (Required)</label><br/>
                  <input type="radio" name="locations" for="locations" value="rescue1" required>
                  <label for "rescue1">Rescue 1</label>
                  <input type="radio" name="locations" for="locations" value="rescue2">
                  <label for "rescue2">Rescue 2</label>
                  <input type="radio" name="locations" for="locations" value="rescue3">
                  <label for "rescue3">Rescue 3</label><br/>
                  <input type="radio" name="locations" for="locations" value="shelter102">
                  <label for "shelter102">Shelter 102</label>
                  <input type="radio" name="locations" for="locations" value="shelter103">
                  <label for "shelter103">Shelter 103</label>
                  <input type="radio" name="locations" for="locations" value="shelter104">
                  <label for "shelter104">Shelter 104</label>
                  <input type="radio" name="locations" for="locations" value="shelter106">
                  <label for "shelter106">Shelter 106</label>
                  <input type="radio" name="locations" for="locations" value="shelter107">
                  <label for "shelter107">Shelter 107</label>
                  <input type="radio" name="locations" for="locations" value="shelter108">
                  <label for "shelter108">Shelter 108</label><br/>
                  <input type="radio" name="locations" for="locations" value="spca1">
                  <label for "spca1">SPCA 1</label>
                  <input type="radio" name="locations" for="locations" value="spca2">
                  <label for "spca2">SPCA 2</label>
                  <input type="radio" name="locations" value="spca3">
                  <label for "spca3">SPCA 3</label><br/>
			      </div>
			      <div>
				        <input type="submit" value=" Volunteer!" name="submit1" />
			      </div>
		   </form>

       <?php
          function addtoVol(){
            $fname = $_POST[VOLUNTEER_FORM_FNAME];
            $lname = $_POST[VOLUNTEER_FORM_LNAME];
            $tel = $_POST[VOLUNTEER_FORM_TEL];
            $street = $_POST[VOLUNTEER_FORM_STREET];
            $city = $_POST[VOLUNTEER_FORM_CITY];
            $province = $_POST[VOLUNTEER_FORM_PROVINCE];
            $postalCode = $_POST[VOLUNTEER_FORM_POSTAL];
            $orgName = $_POST["locations"];
            $owner = "No";
            $dbh = new PDO('mysql:host=localhost;dbname=group26', "root", "");
            $stmtvol1= $dbh->prepare("INSERT INTO people VALUES(:fname, :lname, :telephone,
              :street, :city, :province, :postalCode)");
            $stmtvol2= $dbh->prepare("INSERT INTO employees VALUES(:orgName, :fname, :lname)");
            $stmtvol3= $dbh->prepare("INSERT INTO rescuers VALUES(:OWNER, :fname, :lname)");
            $stmtvol4= $dbh->prepare("INSERT INTO shelterstaff VALUES(:OWNER, :fname, :lname)");
            $stmtvol5= $dbh->prepare("INSERT INTO spcastaff VALUES(:fname, :lname)");
            $stmtvol1->bindParam(':fname',$fname);
            $stmtvol1->bindParam(':lname',$lname);
            $stmtvol1->bindParam(':telephone',$tel);
            $stmtvol1->bindParam(':street',$street);
            $stmtvol1->bindParam(':city',$city);
            $stmtvol1->bindParam(':province',$province);
            $stmtvol1->bindParam(':postalCode',$postalCode);
            $stmtvol2->bindParam(':fname',$fname);
            $stmtvol2->bindParam(':lname',$lname);
            $stmtvol2->bindParam(':orgName',$orgName);
            $stmtvol3->bindParam(':fname',$fname);
            $stmtvol3->bindParam(':lname',$lname);
            $stmtvol3->bindParam(':OWNER',$owner);
            $stmtvol4->bindParam(':fname',$fname);
            $stmtvol4->bindParam(':lname',$lname);
            $stmtvol4->bindParam(':OWNER',$owner);
            $stmtvol5->bindParam(':fname',$fname);
            $stmtvol5->bindParam(':lname',$lname);
            $stmtvol1->execute();
            $stmtvol2->execute();
            if($orgName == "rescue1" || $orgName == "rescue2" || $orgName == "rescue3"){
              $stmtvol3->execute();
            }
            if($orgName == "spca1" || $orgName == "spca2" || $orgName == "spca3"){
              $stmtvol5->execute();
            }
            else {
              $stmtvol4->execute();
            }
          }
          if(isset($_POST['submit1'])){
            addtoVol();
          }

        ?>
       <div>
         <h2>Looking for Drivers!</h2>
         <blockquote>
           We are also looking for drivers! Be the animals shepard on their
           journey to their forever homes! Only requirement is to own your own
           car and have a valid G drivers licence (or equivalent).
         </blockquote>
       </div>
         <form id="driver-form" method="post" action="volunteer.php">
             <div class= "name-row">
               <label for="<?= DRIVER_FORM_FNAME ?>">First Name (required):</label>
                   <input type="text" name="<?= DRIVER_FORM_FNAME ?>" id="<?= DRIVER_FORM_FNAME ?>" maxlength="50" required/>
               <label for="<?= DRIVER_FORM_LNAME ?>">Last Name (required):</label>
                   <input type="text" name="<?= DRIVER_FORM_LNAME ?>" id="<?= DRIVER_FORM_LNAME ?>" maxlength="50" required/>
             </div>
            <div class="tel-row">
                 <label for="<?= DRIVER_FORM_TEL ?>">Telephone (required):</label>
                     <input type="tel" name="<?= DRIVER_FORM_TEL ?>" id="<?= DRIVER_FORM_TEL ?>" maxlength="10" required/>
            </div>
             <div class= "address-row">
               <label for="<?= DRIVER_FORM_STREET ?>">Street(required):</label>
                   <input type="text" name="<?= DRIVER_FORM_STREET ?>" id="<?= DRIVER_FORM_STREET ?>" maxlength="50" required/>
              <br/>
               <label for="<?= DRIVER_FORM_CITY ?>">City(required):</label>
                   <input type="text" name="<?= DRIVER_FORM_CITY ?>" id="<?= DRIVER_FORM_CITY ?>" maxlength="50" required/>
               <br/>
               <label for="<?= DRIVER_FORM_PROVINCE ?>">Province(required):</label>
                   <input type="text" name="<?= DRIVER_FORM_PROVINCE?>" id="<?= DRIVER_FORM_PROVINCE ?>" maxlength="25" required/>
               <br/>
               <label for="<?= DRIVER_FORM_POSTAL ?>">Postal Code (required):</label>
                   <input type="text" name="<?= DRIVER_FORM_POSTAL ?>" id="<?= DRIVER_FORM_POSTAL ?>" maxlength="7" required/>
             </div>
            <div>
              <label for="<?= DRIVER_FORM_PLATE ?>">Licence Plate Number(required):</label>
                  <input type="text" name="<?= DRIVER_FORM_PLATE ?>" id="<?= DRIVER_FORM_PLATE ?>" maxlength="50" required/>
              <label for="<?= DRIVER_FORM_LICENCE ?>">Licence Number (required):</label>
                  <input type="text" name="<?= DRIVER_FORM_LICENCE ?>" id="<?= DRIVER_FORM_LICENCE ?>" maxlength="50" required/>
            </div>
            <div>
                <input type="submit" value=" Volunteer!" name="submit2" />
            </div>
       </form>
       <?php
          function addtoDriver(){
             $fname = $_POST[DRIVER_FORM_FNAME];
             $lname = $_POST[DRIVER_FORM_LNAME];
             $tel = $_POST[DRIVER_FORM_TEL];
             $street = $_POST[DRIVER_FORM_STREET];
             $city = $_POST[DRIVER_FORM_CITY];
             $province = $_POST[DRIVER_FORM_PROVINCE];
             $postalCode = $_POST[DRIVER_FORM_POSTAL];
             $licenceNumber = $_POST[DRIVER_FORM_LICENCE];
             $licencePlates = $_POST[DRIVER_FORM_PLATE];
             $dbh = new PDO('mysql:host=localhost;dbname=group26', "root", "");
             $stmtdriver1 = $dbh->prepare("INSERT into people values(:fname, :lname, :telephone,
               :street, :city, :province, :postalCode)");
             $stmtdriver2 = $dbh->prepare("INSERT into drivers values(:licencePlates, :licenceNumber, :fname, :lname)");
             $stmtdriver1->bindParam(':fname',$fname);
             $stmtdriver1->bindParam(':lname',$lname);
             $stmtdriver1->bindParam(':telephone',$tel);
             $stmtdriver1->bindParam(':street',$street);
             $stmtdriver1->bindParam(':city',$city);
             $stmtdriver1->bindParam(':province',$province);
             $stmtdriver1->bindParam(':postalCode',$postalCode);
             $stmtdriver2->bindParam(':fname',$fname);
             $stmtdriver2->bindParam(':lname',$lname);
             $stmtdriver2->bindParam(':licenceNumber',$licenceNumber);
             $stmtdriver2->bindParam(':licencePlates',$licencePlates);
             $stmtdriver1->execute();
             $stmtdriver2->execute();
           }
          if(isset($_POST['submit2'])){
            addtoDriver();
          }

        ?>
  </main>
</body>
</html>
