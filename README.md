<h1>Language and Studies</h1>

<h2>Overview</h2>

How does making a project that connects people to materials on human language sound? It surely sounded nice to me, since Language is the greatest mean to knowledge. Now, how does Language relate to Studies? For example, how may a difference in language change our perceptions and, therefore, our conclusions? Why do we express things such as world games? These are questions that came to mind for a while, and they surely seem to be persistent and never given a complete answer. Irrespective of the controversies around such linguistic issue, since it makes a connection between methodological and philosophical topics, this project is an attempt to give access to a variety of topics relating to the issue. If you're interested, you're most welcome. Any contributions or changes to the site are welcome- as long as they are safe and legal, of course. The project additionally provides other features, such as feedback and response insertions from an end-user account and Admin account.

The website uses HTML, CSS, JavaScript, PHP and SQL:  
- HTML and CSS for adding and formatting elements,  
- JavaScript for minor front-end responsive features,  
- PHP for back-end connection to a relational database  
- and SQL for creating a relational database.

The tools and editors used in developing the system are:  
- Visual Studio (Optional),  
- Xampp with phpMyAdmin and Apache activated.

There are some issues in the system, however, one of them is in image display as well as some code inconsistencies. For example, there is the display of database elements. Articles and materials are displayed using a for loop, that handles errors relating to inexistence of matching materials. Such structure may be inefficient in the long run, because with an auto incremented ID, the more you delete from feedback the more unnecessary requests from database are made and handled. Other displays however include a while loop, which is less complex and seemingly does not make unnecessary requests the way a for loop does.

Other problems include:  
- Updated profile picture display requiring refresh of the page,  
- Disturbing refresh on submission, which is the default state of PHP,  
- Materials inserted do not include their post images.  
- No filtering for resources depending on the source they are attributed to

Feel free to contribute by fixing such issues, some of them are theoretically easy, and some aren't.

<h2>Running and Using the System</h2>

To run the project, a setup is needed. First, you should download XAMPP from [HERE](https://www.apachefriends.org/). Afterwards, copy the project files provided in htdocs, which is in your xampp directory (expectedly c:/xampp/htdocs). open the xampp control panel, which should be already installed, and activate Apache and MySQL. Open [phpMyAdmin](Localhost:/phpmyadmin/index.php), and click on the button 'New' in the top left corner of the screen. You will find a 'Database name' textbox, in which you should write lmdatabase and click 'Create'. After clicking on the 'lmdatabase' newly created below 'information_schema', click the 'SQL' tab shown in tabs above. Copy the SQLi commands provided in the [SQL file](sql.txt) and paste it to the text field, then click Ctrl+Enter.

Now, the database is set. All you need to do afterwards is populate it through the system. Open the [locally hosted project](Main%20Page.php) and try adding some things. recommendedly do the following:  
- Create a user account and login with it (Login/Signup).  
- Create a feedback while logged in [Categories](Categories.php).  
- Go to main page and update your profile picture.  
- Login as an [Admin](Admin%20Login.php) with Name: John, Surname: Doe, Password: Password, SKey: 123(This account is inserted for experiment. No account insertion service is made in the client platform for integrity reasons).  
- Try [adding a Resource, then a source](AddResource.php)  
- Go back then to [Categories](Categories.php), check the resource, and click on it.  
- Try updating the resource by clicking ('Edit') and changing the content.  
- Try deleting the resource by clicking ('Delete').  
- Go back to [feedback page](Feedbacks.php), click on the feedback you made and respond to it.

**That's it, you've known how to do the job.**
