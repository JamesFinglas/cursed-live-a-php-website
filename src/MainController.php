<?php
namespace Itb;

class MainController
{
    private $twig;

    private $userController;

    public function __construct(\twig\Environment $twig)
    {
        $this->twig = $twig;
        $this->userController = new UserController();
    }

    /* ----- login controller functions ---------*/
    public function setUsernameAction($name)
    {
        $_SESSION['username'] = $name;

        print 'username was set';
    }

    public function showUsernameAction()
    {
        if(isset($_SESSION['username'])){
            print 'username = ' . $_SESSION['username'];
        } else {
            print 'missing SESSION value: ' .  'username';
        }
    }

    public function endSessionAction()
    {
        $this->killSession();

        print 'You have logged out';
    }

    public function killSession()
    {
        $_SESSION = [];

        if (ini_get('session.use_cookies')){
            $params = session_get_cookie_params();
            setcookie(	session_name(),
                '', time() - 42000,
                $params['path'], $params['domain'],
                $params['secure'], $params['httponly']
            );
        }
        session_destroy();
    }

    public function logoutAction()
    {
        $this->killSession();
        $this->homeAction();
    }

     public function processLoginAction($username, $password)
     {
         $password_hashed = password_hash($password, PASSWORD_DEFAULT);

         if($this->validCredentialsAdmin($username, $password_hashed)){

             $_SESSION['username'] = $username;
             $username = $this->usernameFromSession();
             $this->indexAction();

         }else{
             $template = 'loginError.html.twig';
             $argsArray = [
                 'pageTitle' => 'Bad Login'
             ];
             $html = $this->twig->render($template, $argsArray);
             print $html;
         }
     }

    public function processLogoutAction()
    {
        $this->endSessionAction();

        $template = 'home.html.twig';
        $argsArray = [
            'pageTitle' => 'Home',
            'username' => $this->usernameFromSession()

        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;

    }

    private function validCredentialsAdmin($u, $p)
    {
        if('admin' == $u && password_verify('admin', $p)){
            return true;
        }
        else if('staff' == $u && password_verify('staff', $p)){
            return true;
        } else {
            return false;
        }
    }

     public function isLoggedIn()
     {
         if(isset($_SESSION['username'])){
             return true;
         }else{
             return false;
         }
     }

     public function usernameFromSession()
     {
         if(isset($_SESSION['username'])){
             return $_SESSION['username'];
         }else{
             return '';
         }
     }
     /*-------- end login controller functions*/

    //secondary home page link
    public function homeAction()
    {
        $isLoggedIn = $this->userController->isLoggedIn();
        //$username = $this->userController->usernameFromSession();

        $argsArray = [
            //'username' => $username,
            'pageTitle' => 'Home',
            'username' => $this->usernameFromSession()

        ];
        $template = 'home.html.twig';

        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //home page / default link
    public function indexAction()
    {
        $template = 'home.html.twig';
        $argsArray = [
            'pageTitle' => 'Home',
            'username' => $this->usernameFromSession()

        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //link to admin page , display tables on admin page
    public function adminAction()
    {
        $visitorRepository = new VisitorRepository();
        $visitors = $visitorRepository->getAllFromVisitors();

        $staffRepository = new StaffRepository();
        $staffs = $staffRepository->getAllFromStaffs();

        $productRepository = new productRepository();
        $products = $productRepository->getAllFromProducts();

        $adminRepository = new adminRepository();
        $admins = $adminRepository->getAllFromAdmins();

        $template = 'admin.html.twig';
        $args = [
            'pageTitle' => 'Admin',
            'username' => $this->usernameFromSession(),
            'visitors' => $visitors,
            'products' => $products,
            'staffs' => $staffs,
            'admins' => $admins
        ];
        $html = $this->twig->render($template, $args);
        print $html;
    }

    //link to site map page
    public function siteAction()
    {
        $template = 'siteMap.html.twig';
        $argsArray = [
            'pageTitle' => 'SiteMap',
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //link to about page
    public function aboutAction()
    {
        $template = 'about.html.twig';
        $argsArray = [
            'pageTitle' => 'About',
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //link to plain table merchandise page
    public function merchandiseAction()
    {
        $productRepository = new productRepository();
        $products = $productRepository->getAllFromProducts();

        $template = 'merchandise.html.twig';
        $argsArray = [
            'pageTitle' => 'Merchandise',
            'products' => $products,
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //link to merchandise page with javascript table
    public function merchandiseAction2()
    {
        $productRepository = new ProductRepository();
        $products = $productRepository->getAllFromProducts();

        $template = 'merchandise2.html.twig';
        $argsArray = [
            'pageTitle' => 'Merchandise2',
            'products' => $products,
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //link to cast page
    public function castAction()
    {
        $characterRepository = new CharacterRepository();
        $characters = $characterRepository->getAllFromCharacters();

        $template = 'cast.html.twig';
        $argsArray = [
            'pageTitle' => 'Cast',
            'characters' => $characters,
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //link to create a visitor account page
    public function visitorAction()
    {
        $template = 'visitorForm.html.twig';
        $argsArray = [
            'pageTitle' => 'Visitor',
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //link to create a user page
    public function userAction()
    {
        $template = 'userForm.html.twig';
        $argsArray = [
            'pageTitle' => 'User',
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //link to confirm product insert page
    public function confirmProductInsert($id)
    {
        $productRepository = new ProductRepository();
        $product = $productRepository->getOneFromProducts($id);

        $template = 'confirmProductInsertForm.html.twig';
        $argsArray = [
            'pageTitle' => 'Confirm New Product',
            'product' => $product,
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //link to confirm product delete page
    public function confirmProductDelete($id)
    {
        $productRepository = new productRepository();
        $product = $productRepository->getOneFromProducts($id);

        $template = 'confirmProductDeleteForm.html.twig';
        $argsArray = [
            'pageTitle' => 'Confirm Deletion of Product',
            'product' => $product,
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //link to confirm product update page
    public function confirmProductUpdate($id, $description, $price, $image)
    {

        $productRepository = new productRepository();

        $productRepository->updateProduct($id, $description, $price, $image);

        $product = $productRepository->getOneFromProducts($id);

        $template = 'confirmProductUpdateForm.html.twig';
        $argsArray = [
            'pageTitle' => 'Confirm Product Update',
            'product' => $product,
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //link to confirm insert staff page
    public function confirmUserInsert($id)
    {
        $staffRepository = new StaffRepository();
        $staff = $staffRepository->getOneFromStaffs($id);

        $template = 'confirmUserInsertForm.html.twig';
        $argsArray = [
            'pageTitle' => 'Confirm New User',
            'staff' => $staff,
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //link to confirm staff delete page
    public function confirmUserDelete($id)
    {
        $staffRepository = new StaffRepository();

        $staffRepository->deleteOneFromStaffs($id);

        //$staff = $staffRepository->getOneFromStaffs($id);

        $template = 'confirmUserDeleteForm.html.twig';
        $argsArray = [
            'pageTitle' => 'Confirm Deletion of User',
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //link to confirm staff update page
    public function confirmUserUpdate($id)
    {
        $staffRepository = new StaffRepository();
        $staff = $staffRepository->getOneFromStaffs($id);

        $template = 'confirmUserUpdateForm.html.twig';
        $argsArray = [
            'pageTitle' => 'Confirm User Update',
            'staff' => $staff,
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //link to confirm insert admin page
    public function confirmAdminInsert($id)
    {
        //var_dump($id);
        //die();

        $adminRepository = new AdminRepository();
        $admin = $adminRepository->getOneFromAdmins($id);

        //var_dump($admin);
        //die();

        $template = 'confirmAdminInsertForm.html.twig';
        $argsArray = [
            'pageTitle' => 'Confirm New Admin',
            'admin' => $admin,
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //link to confirm admin delete page
    public function confirmAdminDelete($id)
    {
        //var_dump('working');
        //die();

        $adminRepository = new AdminRepository();
        $adminRepository->deleteOneFromAdmins($id);

        //$admin = $adminRepository->getOneFromAdmins($id);

        $template = 'confirmAdminDeleteForm.html.twig';
        $argsArray = [
            'pageTitle' => 'Confirm Deletion of Admin',
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //link to confirm user update page
    public function confirmAdminUpdate($id)
    {
        //var_dump('working');
        //die();

        $adminRepository = new AdminRepository();
        $admin = $adminRepository->getOneFromAdmins($id);

        $template = 'confirmAdminUpdateForm.html.twig';
        $argsArray = [
            'pageTitle' => 'Confirm Admin Update',
            'admin' => $admin,
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //link to confirm visitor insert page
    public function confirmVisitorInsert($id)
    {
        $visitorRepository = new visitorRepository();
        $visitor = $visitorRepository->getOneFromVisitors($id);

        $template = 'confirmVisitorInsertForm.html.twig';
        $argsArray = [
            'pageTitle' => 'Confirm New User',
            'visitor' => $visitor,
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //link to confirm user delete page
    public function confirmVisitorDelete($id)
    {
        $visitorRepository = new VisitorRepository();
        $visitor = $visitorRepository->getOneFromvisitors($id);

        $template = 'confirmVisitorDeleteForm.html.twig';
        $argsArray = [
            'pageTitle' => 'Confirm Deletion of User',
            'visitor' => $visitor,
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //link to create a product page
    public function insertProduct()
    {
        $template = 'insertProductForm.html.twig';
        $argsArray = [
            'pageTitle' => 'Insert Product Form',
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //link to delete a product page
    public function deleteProduct()
    {
        $template = 'deleteProductForm.html.twig';
        $argsArray = [
            'pageTitle' => 'Delete Product Form',
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //link to update a product page
    public function updateProduct()
    {
        $template = 'updateProductForm.html.twig';
        $argsArray = [
            'pageTitle' => 'Update Product Form',
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //link to create a visitor account page
    public function insertVisitor()
    {
        $template = 'insertVisitorForm.html.twig';
        $argsArray = [
            'pageTitle' => 'Insert Visitor Form',
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //link to delete a visitor page
    public function deleteVisitor()
    {
        $template = 'deleteVisitorForm.html.twig';
        $argsArray = [
            'pageTitle' => 'Delete visitor Form',
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //link to confirm visitor update page
    public function confirmVisitorUpdate($id)
    {
        $visitorRepository = new VisitorRepository();
        $visitor = $visitorRepository->getOneFromVisitors($id);

        $template = 'confirmVisitorUpdateForm.html.twig';
        $argsArray = [
            'pageTitle' => 'Confirm Visitor Update',
            'visitor' => $visitor,
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //link to update a user page
    public function updateVisitor()
    {
        $template = 'updateVisitorForm.html.twig';
        $argsArray = [
            'pageTitle' => 'Update Visitor Form',
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //link to create a user account page
    public function insertUser()
    {
        $template = 'insertUserForm.html.twig';
        $argsArray = [
            'pageTitle' => 'Create user Form',
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //link to delete a user page
    public function deleteUser()
    {
        $template = 'deleteUserForm.html.twig';
        $argsArray = [
            'pageTitle' => 'Delete User Form',
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //link to update a user page
    public function updateUser()
    {
        $template = 'updateUserForm.html.twig';
        $argsArray = [
            'pageTitle' => 'Update User Form',
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //link to create a user account page
    public function insertAdmin()
    {
        $template = 'insertAdminForm.html.twig';
        $argsArray = [
            'pageTitle' => 'Create Admin Form',
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //link to delete a user page
    public function deleteAdmin()
    {
        $template = 'deleteAdminForm.html.twig';
        $argsArray = [
            'pageTitle' => 'Delete Admin Form',
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }

    //link to update a user page
    public function updateAdmin()
    {
        $template = 'updateAdminForm.html.twig';
        $argsArray = [
            'pageTitle' => 'Update Admin Form',
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $argsArray);
        print $html;
    }


    //display tables on staff page
    public function staffAction()
    {
        $visitorRepository = new VisitorRepository();
        $visitors = $visitorRepository->getAllFromVisitors();

        $productRepository = new productRepository();
        $products = $productRepository->getAllFromProducts();

        $template = 'staff.html.twig';
        $args = [
            'pageTitle' => 'Staff',
            'visitors' => $visitors,
            'products' => $products,
            'username' => $this->usernameFromSession()
        ];
        $html = $this->twig->render($template, $args);
        print $html;
    }

    //table per page display biography for cast page
    public function showBio($id)
    {
        $characterRepository = new CharacterRepository();
        $character = $characterRepository->getOnefromCharacters($id);

        $template = 'showBio.html.twig';
        $args = ['character' => $character,
            'pageTitle' => 'showBio',
            'username' => $this->usernameFromSession()
        ];

        $html = $this->twig->render($template, $args);
        print $html;
    }

    //table per page display image for merchandise page
    public function showImage($id)
    {
        $productRepository = new ProductRepository();
        $product = $productRepository->getOnefromProducts($id);

        $template = 'showImage.html.twig';
        $args = ['product' => $product,
            'pageTitle' => 'showImage',
            'username' => $this->usernameFromSession()
        ];

        $html = $this->twig->render($template, $args);
        print $html;
    }

    //function to insert product with optional test
    public function processNewProductAction($description, $price, $image)
    {
        /*print 'price =' . $price;
        die();*/

        $productRepository = new ProductRepository();
        $id = $productRepository->insertIntoProducts($description, $price, $image);

        /*print 'new product should be created with id = ' . $id;
        die();*/

        $this->confirmProductInsert($id);
    }

    //function to delete a product with optional test
    public function processDeleteProductAction($id)
    {
        /*print 'price =' . $price;
        die();*/

        $productRepository = new ProductRepository();
        $id = $productRepository->deleteOneFromProducts($id);

        /*print 'new product should be created with id = ' . $id;
        die();*/

        $this->confirmProductDelete($id);
    }

    //function to update a product with optional test
    public function processUpdateProductAction($id, $description, $price, $image)
    {
        /*print 'price =' . $price;
        die();*/

        $productRepository = new ProductRepository();
        $productRepository->updateProduct($id,$description, $price, $image);

        /*print 'new product should be created with id = ' . $id;
        die();*/

        $this->confirmProductUpdate($id, $description, $price, $image);
    }

    //function to insert a new user with optional test
    public function processNewUserAction($username, $password)
    {
        /*print 'username =' . $username;
        die();*/

        $staffRepository = new StaffRepository();
        $id = $staffRepository->insertIntoStaffs($username, $password);

        /*print 'new user should be created with id = ' . $id;
        die();*/

        $this->confirmUserInsert($id);
    }

    //function to insert a new staff member with optional test
    public function processNewUserAccountAction($username, $password)
    {
        /*print 'username =' . $username;
        die();*/

        $staffRepository = new StaffRepository();
        $id = $staffRepository->insertIntoStaffs($username, $password);

        /*print 'new user should be created with id = ' . $id;
        die();*/

        $this->confirmUserInsert($id);
    }

    //function to delete a product with optional test
    public function processDeleteUserAction($id)
    {
        /*print 'username =' . $username;
        die();*/

        $staffRepository = new StaffRepository();
        $id = $staffRepository->deleteOneFromStaffs($id);

        /*print 'new user should be created with id = ' . $id;
        die();*/

        $this->confirmUserDelete($id);
    }

    public function processUpdateUserAction($id,$username, $password)
    {
        /*print 'username =' . $username;
        die();*/

        $staffRepository = new StaffRepository();
        $staffRepository->updateStaffs($id, $username,$password);

        /*print 'new user should be created with id = ' . $id;
        die();*/

        $this->confirmUserUpdate($id);
    }

    //function to insert a new admin with optional test
    public function processNewAdminAction($username, $password)
    {
        /*print 'username =' . $username;
        die();*/

        $adminRepository = new AdminRepository();
        $id = $adminRepository->insertIntoAdmins($username, $password);

        /*print 'new user should be created with id = ' . $id;
        die();*/

        $this->confirmAdminInsert($id);
    }

    //function to delete an admin with optional test
    public function processDeleteAdminAction($id)
    {
        /*print 'username =' . $username;
        die();*/

        $adminRepository = new AdminRepository();
        $id = $adminRepository->deleteOneFromAdmins($id);

        /*print 'new user should be created with id = ' . $id;
        die();*/

        $this->confirmAdminDelete($id);
    }

    //function to update an admin with optional test
    public function processUpdateAdminAction($id,$username, $password)
    {
        /*print 'username =' . $username;
        die();*/

        $adminRepository = new AdminRepository();
        $adminRepository->updateAdmins($id, $username,$password);

        /*print 'new user should be created with id = ' . $id;
        die();*/

        $this->confirmAdminUpdate($id);
    }

    //function to delete a visitor with optional test
    public function processDeleteVisitorAction($id)
    {
        /*print 'username =' . $username;
        die();*/

        $visitorRepository = new VisitorRepository();
        $id = $visitorRepository->deleteOneFromVisitors($id);

        /*print 'new user should be created with id = ' . $id;
        die();*/

        $this->confirmVisitorDelete($id);
    }

    //function to update a visitor
    public function processUpdateVisitorAction($id, $username, $email)
    {

        $visitorRepository = new VisitorRepository();
        $visitorRepository->updateVisitors($id, $username, $email);

        $this->confirmVisitorUpdate($id);
    }

    //function to insert a new visitor with optional test
    public function processNewVisitorAction($username, $email)
    {
        /*print 'username =' . $username;
        die();*/

        $visitorRepository = new visitorRepository();
        $id = $visitorRepository->insertIntoVisitors($username, $email);

        /*print 'new user should be created with id = ' . $id;
        die();*/

        $this->confirmVisitorInsert($id);
    }
}