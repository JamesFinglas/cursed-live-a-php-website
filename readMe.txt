Cursed live, a website template created by James Finglas. C/O Institute of Technology Dublin, 2016/17.

(1) This Website was coded via 'Jetbrains PHPStorm' and i highly recommend that IDE for running the site locally.
alternatively any other php IDE should work. And you will want to install composer as a quality of life time saver.

(2) In order to run the site you will need to manually set up a mysql database called 'cursedpr_cursed'. Your mysql 
login details should be username='root' password='root'. Alternaively , if your details are different, in the 
Database.php script you can alter these details to suit your current details, hwoever; anywhere else the previous 
details are called must also be changed.

(3) This must be selected as your default schema. 

(4) In order to properly test the site, the database script must be executed first to set up the database tables.
navigate tot he web folder and type 'php setup_database.php'. This will create and poipulate your tables.

Once this is done the site should function normally.

Assuming composer has been installed, navigate to the web folder, type 'Composer run' to launch the site locally. 
If prompted to use the composer.json file located in /web hit y and then enter.

If composer has not been installed, navigate tot he web folder and type 'php -S Localhost:8000 -t ./web'.

Once the site has launch without errors , open your browsers and enter 'Localhost:8000' t view the site.


TO DO LIST:

(1) Session is not yet fully implemented. Currently it is only a hardcode session stored locally.

(2) hardcoded details are currently used for both admin and staff logins ,admin username = 'admin' admin password = 'admin'.
    staff username  = staff 'staff' password = staff'. Naturally i intend to replace this also with hardcoded encryppted passwords
    stored and retrieved and verified bia the database.

(3) sanitization a CSRF protetions (anti XSS scripts).

(4) basic input protctiosn to negate incorrect inputs, such as  ints instead of strings and vice versa, or negative ints where 
    such would break the main controller functionality.

(5) Where the merchandizing table exists, i has implemented a much more interactive, javascript based merchandizing price calculator.
    it was removed at the request of my then instructor but will be re implemented at a later date.


Regards,

James Finglas, 2018.