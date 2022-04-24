# COMP1044_CW_G8
Course Work 2 Library Data Base

The following files are for the CW2 for COMP1044 Databases and Interfaces taught at the University of Nottingham Malaysia (UNMC).
The Group 8 members consist of:
- Chew Zi Ee (20410322)
- Desmond Lau Jun Hong (20297550)
- James Tang Tzeun Zhu (20417757)
- Keshaav Suhash Rudra (20415777)
- Mohamed Yasin Azeez (20184533)

NOTE:    
Step 1 - Download source file and librarydbSQL.sql from the Github Repository.

Step 2 - Relocate source file to the "C:\xampp\htdocs" directory on your computer.

Step 3 - Launch XAMPP Control Panel and start the Apache and MySQL modules.

Step 4 - Click on Admin for MySQL Module, you will be redirected to the phpMyAdmin webpage.

Step 5 - Click on New and make sure you insert "librarydb" in the "Datbase name" input row then click on Create.

Step 6 - Click on Import in the ribbon, if Import is not found click on the Hamburger Icon (Triple horizontal stripes) and click on "Choose File" and choose librarydbSQL.sql where you download in step 1.

Step 7 - launch your desired Web Browser Application and key in "localhost/source/login.php" to load the main page of the project.

Step 8 - Start using the features on the website and for editing purposes and edit the entries in the database.



IN THE CASE OF CONNECTION ERRORS PLEASE TRY THE FOLLOWING:
- Access source/includes/conn.php file and changing the following:
    - Set variable $severname to your severname
    - Set variable $username to your username
    - Set variable $password to your password
    - Set variable $db to your database name you created in phpMyAdmin
