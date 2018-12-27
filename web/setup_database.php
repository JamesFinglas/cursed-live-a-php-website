<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Itb\CharacterRepository;
use Itb\ProductRepository;
use Itb\UserRepository;
use Itb\VisitorRepository;
use Itb\StaffRepository;
use Itb\AdminRepository;

$castRepository = new CharacterRepository();

$castRepository->dropTableCharacters();
$castRepository->createTableCharacters();

$castRepository->deleteAllFromCharacters();

$castRepository->insertIntoCharacters('Harry Potter, Played by Jamie Glower (originally Jamie Parker)', 'Harry Potter, The boy who lived');
$castRepository->insertIntoCharacters('Ron Weasley, Played by Thomas Aldridge (originally Paul Thornley)', 'Son of Arthur Weasley');
$castRepository->insertIntoCharacters('Hermione Granger, Played by Rakie Ayola (originally Noma Dumezweni)', 'Greatest witch of her age');
$castRepository->insertIntoCharacters('Ginny Potter, Played by Emma Lowndes (originally Poppy Miller)', 'Harrys wife, Rons sister');
$castRepository->insertIntoCharacters('Draco Malfoy, Played by James Howard (originally Alex Price)', 'Son of Lucious');
$castRepository->insertIntoCharacters('Albus Severus Potter, Played by Theo Ancient (originally Sam Clemmett)', 'The greatest Wizard ever');
$castRepository->insertIntoCharacters('Scorpius Malfoy, Played by Samuel Blenkin (originally Anthony Boyle)', 'Son Draco, Albus best friend');
$castRepository->insertIntoCharacters('Rose Granger-Weasley, Played by Helen Aluko (originally Cherrelle Skeete)', 'Daughter of Ron and Hermione');
$castRepository->insertIntoCharacters('Young Hermione Granger, Played by Helen Aluko (originally Cherrelle Skeete)', 'Lover of the restricted section');
$castRepository->insertIntoCharacters('Delphi Diggory (Delphi Riddle), Played by Annabel Baldwin (originally Esther Smith)', 'Bastard child of Lord voldemort and Belatrix Lestrange');
$castRepository->insertIntoCharacters('Craig Bowker Jr., Played by James Phoon (originally Jeremy Ang Jones)', 'Filler Character');
$castRepository->insertIntoCharacters('Moaning Myrtle, Played by April Hughes (originally Annabel Baldwin)', 'Most famous victim of the basilisk from the chamber of secrets');
$castRepository->insertIntoCharacters('Lily Potter Snr, Played by April Hughes (originally Annabel Baldwin)', 'Daughter of Harry and Ginny');
$castRepository->insertIntoCharacters('Polly Chapman, Played by Sarah Miele (originally claudia Grant)', 'Filler Character');
$castRepository->insertIntoCharacters('Vernon Dudley, Played by David Annen (originally Paul Bentall)', 'Harrys cousin');
$castRepository->insertIntoCharacters('Severus Snape, Played by David Annen (originally Paul Bentall)', 'The bravest wizard Harry ever knew');
$castRepository->insertIntoCharacters('Lord Voldemort (Tom Marvolo Riddle), Played by David Annen (originally Paul Bentall)', 'He who can now be named, because hes dead. Or is he?');
$castRepository->insertIntoCharacters('Rubeus Hagrid, Played by Mark Theodore (originally Chris Jarman)', 'Keeper of keys and grounds at Hogwarts, and a smashing good bloke');
$castRepository->insertIntoCharacters('Sorting Hat, Played by Mark Theodore (originally Chris Jarman)', 'Its just a hat. that talks, and reads minds. fear it!');
$castRepository->insertIntoCharacters('Yan Fredericks, Played by Henry Rundle (originally James Le Lacher)', 'Filler Character');
$castRepository->insertIntoCharacters('Petunia Dursley, Played by Elizabeth Hill (originally Helena Lymbery)', 'Harrys Aunt');
$castRepository->insertIntoCharacters('Madam Hooch, Played by Elizabeth Hill (originally Helena Lymbery)', 'Quiditch trainer and referee at Hogwarts');
$castRepository->insertIntoCharacters('Delores Umbridge, Played by Elizabeth Hill (originally Helena Lymbery)', 'Vile evil stumpy gargoyle');
$castRepository->insertIntoCharacters('Trolley Witch, Played by Jamie Glower (originally Jamie Parker)', 'A deadly monster');
$castRepository->insertIntoCharacters('Minerva McGonagall, Played by Sandy McDade (originally Sandy McDade)', 'Head of gryffindor House, vice principal, and part of the furniture at Hogwarts');
$castRepository->insertIntoCharacters('Cedric Diggory, Played by Rupert Henderson (originally Tom Milligan)', 'The boy who didnt live. Shame really. Nice bloke.');
$castRepository->insertIntoCharacters('James Sirius Potter, Played by Rupert Henderson (originally Tom Milligan)', 'Oldest son of Harry and Ginny');
$castRepository->insertIntoCharacters('James Potter Snr, Played by Rupert Henderson (originally Tom Milligan)', 'Harrys father');
$castRepository->insertIntoCharacters('Dudley Dursley, Played by Tom Mackley (originally Jack North)', 'Harrys uncle');
$castRepository->insertIntoCharacters('Karl Jenkins, Played by Tom Mackley (originally Jack North)', 'Filler Character');
$castRepository->insertIntoCharacters('Victor Krum, Played by Tom Mackley (originally Jack North)', 'Hermiones old squeeze');
$castRepository->insertIntoCharacters('Bane, Played by Nuno Silva (originally Nuno Silva)', 'Proud and quite aggressive leader of the Centaurs');
$castRepository->insertIntoCharacters('Young Harry Potter, Played by Jabez Cheeseman, Alfred Jones, Harrison Noble, Ben Roberts and Freddie Preston (originally Rudi Goodman, Alfred Jones, Bili Keogh, Ewan Rutherford, Nathaniel Smith and Dylan Standen)', 'Needs no explanation');
$castRepository->insertIntoCharacters('Young Lily Luna Potter, Played by Phoebe Austen, Esme Grace, Hope Sizer, Ava Palmer and Ella Bright (originally Zoe Brough, Cristina Fray and Christiana Hutchings)', 'Needs no explanation');

/* -----------------------------------------------------------------*/

$productRepository = new ProductRepository();

$productRepository->dropProductsTable();
$productRepository->createProductsTable();

$productRepository->deleteAllFromProducts();

$productRepository->insertIntoProducts('Hoodie',29.99, "../images/CC_Hoodie_Front_small.png" );
$productRepository->insertIntoProducts('Shirt',19.99,"../images/CC_men_front_small.png" );
$productRepository->insertIntoProducts('Womens Shirt',19.99,"../images/CC_Woman_front_small.png" );
$productRepository->insertIntoProducts('Sweatshirt',26.00, "../images/Dark_Mark_Sweatshirt_small.png" );
$productRepository->insertIntoProducts('Wand',32.00,"../images/Albus-potter-wand_small.png" );
$productRepository->insertIntoProducts('Screenplay',20.00,"../images/Playscript_front_small.png" );
$productRepository->insertIntoProducts('Ticket',250.00,"../images/ticket.jpg" );

/* ------------------------------------------------------------------*/

$visitorRepository = new VisitorRepository();

$visitorRepository->dropTableVisitors();
$visitorRepository->createTableVisitors();

$visitorRepository->deleteAllFromVisitors();

$visitorRepository->insertIntoVisitors('visitor','visitor@gmail.com' );

/* ------------------------------------------------------------------------*/

$staffRepository = new StaffRepository();

$staffRepository->dropTableStaffs();
$staffRepository->createTableStaffs();

$staffRepository->deleteAllFromStaffs();

$password_hashed = password_hash("staff", PASSWORD_DEFAULT);

$staffRepository->insertIntoStaffs('staff',PASSWORD_DEFAULT );

/*--------------------------------------------------------------------------*/

$adminRepository = new AdminRepository();

$adminRepository->dropTableAdmins();
$adminRepository->createTableAdmins();

$adminRepository->deleteAllFromAdmins();

$password_hashed = password_hash("admin", PASSWORD_DEFAULT);

$adminRepository->insertIntoAdmins('admin',PASSWORD_DEFAULT );



