<style>

  h1 {
  text-align: center;
  }
  
  fieldset {
  backgroud-color: #ffffcc;
  margin-left: auto; margin-right: auto;
  width: 29em;
  }

  form {
  font-family: "Helvetica", sans-serif;
  }

  input {
  margin-left: 3em;
  margin-bottom: 0.5em;
  }

  select {
  margin-left: 3em;
  margin-bottom: 0.5em;
  }
  
  input[type="Submit"] {
  display: inline;
  font-weight: bold;
  margin-left: 20em;
  }

  input[type="button"] {
  display: inline;
  font-weight: bold;
  margin-left: 20em;
  }

  label.heading {
  float: left;
  marin-right: 10em;
  text-align: right;
  width: 10em;
  }
  
</style>

<html>
 <body>
  <h1>CREATE ACCOUNT</h1>

  <form action="register_add.php" method="post">
    <fieldset>
      <div>
	<label class="heading" for="UserName">Username:</label>
	<input type="text" name="UserName" id="UserName" /> <br />
	<label class="heading" for="Password">Password:</label>
	<input type="password" name="Password" id="Password" /> <br />
	<label class="heading" for="PasswordConfirm">Confirm Password:</label>
	<input type="password" name="PasswordConfirm" id="PasswordConfirm"/> <br />
	<label class="heading" name="UserType" />Type of User: </label>
        <select name="UserType">
	  <option value="Member">Georgia Tech Student/Faculty</option>
	  <option value="Employee">GTCR Employee</option>
	  </select><br />
	
     </div>
     <div>
	<input type="Submit" value="Register"/>
     </div>
    </fieldset>
  </form>
   <form action="index.php" method="post">
        <input type="Submit" value="Cancel"/>
   </form>
 </body>
</html>
 
