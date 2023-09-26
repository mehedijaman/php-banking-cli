<?php namespace App;
use App\Models\Customer;
use App\Models\Deposit;
use App\Models\Withdraw;
use App\Models\Transfer;

class Console{
    private string $customerEmail;

    private const LOGIN = 1;
    private const REGISTER = 2;
    private const EXIT = 0;

    private const DEPOSIT = 1;
    private const WITHDRAW = 2;
    private const TRANSFER = 5;
    private const VIEW_DEPOSIT = 3;
    private const VIEW_WITHDRAW = 4;
    private const VIEW_BALANCE = 6;
    private const LOGOUT = 0;



    private array $authOptions = [
        self::LOGIN => 'Login',
        self::REGISTER => 'Register',
        self::EXIT => 'Exit'
    ];

    private array $customerOptions = [
        self::DEPOSIT => 'Deposit',
        self::WITHDRAW => 'Withdraw',
        self::TRANSFER => 'Transfer',
        self::VIEW_DEPOSIT => 'View Deposit',
        self::VIEW_WITHDRAW => 'View Deposit',
        self::VIEW_BALANCE => 'View Balance',
        self::LOGOUT => 'Logout',
    ];

    public function run(){
        while(true) {
            foreach($this->authOptions as $key => $value){
                print $key.' - '.$value.PHP_EOL;
            }

            $choice = (int) readline('Please Select a Option to Proceed: ');
            
            switch ($choice) {
                case self::LOGIN:
                    $this->login();
                    break;
                case self::REGISTER:
                    $this->register();
                    break;
                case self::EXIT:
                    exit(0);
                default:
                    print 'Invalid Choice. Please Select Correct Option'.PHP_EOL;
                    break;
            }
            
        }
    }

    public function login(){
        $email = readline('Email: ');
        if('' == $email){
            print '>> You must enter an email'.PHP_EOL;
            $this->login();
        }

        $password = readline('Password: ');
        if('' == $password){
            print '>> You must enter a password'.PHP_EOL;
            $this->login();
        }

        $customer = new Customer();
        $customer->login($email, $password);
        if($customer->login($email, $password)){
            $this->customerEmail = $email;
            $this->customerOptions();
        }
        else{
            print "Email/Password is invalid !".PHP_EOL;
        }

    }

    public function register(){
        while(true){
            $name = readline('Name: ');            
            if('' == $name){
                print '>> You must enter a name'.PHP_EOL;
                $this->register();
            }

            $email = readline('Email: ');
            if('' == $email){
                print '>> You must enter an email'.PHP_EOL;
                $this->register();
            }
            
            $password = readline('Password: ');
            if('' == $password){
                print ">> You can't set an emppty password".PHP_EOL;
                $this->register();
            }

            $confirmPassword = readline('Confirm Password: ');            
            if($password != $confirmPassword){
                print ">> Password doesn't match. Try again...".PHP_EOL;
                $this->register();
            }

            break;
        }

        $data = [
            'name'  => $name,
            'email' => $email,
            'password' => $password
        ];

        $customer = new Customer();
        $customer->set($data);
        if($customer->register()){
            print 'User Registered Successfully'.PHP_EOL;
        }
    }


    public function customerOptions(){
        while(true){
            foreach($this->customerOptions as $key => $value){
                print$key.': '.$value.PHP_EOL;
            }

            $choice = readline('Please select a option: ');

            switch($choice){
                case self::DEPOSIT:
                    $this->deposit();
                    break;
                case self::WITHDRAW:
                    $this->withdraw();
                    break;
                case self::TRANSFER:
                    $this->transfer();
                    break;
                case self::VIEW_DEPOSIT:
                    $this->viewDeposit();
                    break;
                case self::VIEW_WITHDRAW:
                    $this->viewWithdraw();
                    break;
                case self::VIEW_BALANCE:
                    $this->viewBalance();
                    break;
                case self::LOGOUT:
                    $this->logout();
                    break;
                default:
                    print 'Invalid Choice. Please select correct option.'.PHP_EOL;
                    break;
            }
        }
    }

    public function deposit(){
        $amount = (int) readline('Enter Amount:');
        $deposit = new Deposit();

        try {
            $deposit->store($this->customerEmail, $amount);
            print "Deposit Successfull ".PHP_EOL;
        } catch (\Throwable $th) {
            print "Something went wrong".PHP_EOL;
        }
    }

    public function withdraw(){
        $amount = (int) readline('Enter Withdraw Amount:');
        $withdraw = new Withdraw();

        try {
            $withdraw->store($this->customerEmail, $amount);
            print 'Your withdraw has been successfully done.'.PHP_EOL;
        } catch (\Throwable $th) {
            print "Something went wrong";
        }
    }

    public function transfer(){
        $toAccount = readline('Enter Destination Account Email Address:');
        $amount = (int) readline('Enter Transfer Amount:');

        $transfer = new Transfer();
        try {
            $transfer->store($this->customerEmail, $toAccount, $amount);
            print 'Transfer Completed !'.PHP_EOL;
        } catch (\Throwable $th) {
            print 'Transfer Failed !'.PHP_EOL;
        }
    }

    public function viewDeposit(){    
        $deposits = Deposit::fetch($this->customerEmail);
        print "Deposit List: ".PHP_EOL;
        foreach ($deposits as $deposit){
            print $deposit['date'].' : '.$deposit['amount'].PHP_EOL;
        }
    }

    public function viewWithdraw(){
        $witdraws = Withdraw::fetch($this->customerEmail);
        print "Withdraw List: ".PHP_EOL;
        foreach ($witdraws as $witdraw){
            print $witdraw['date'].' : '.$witdraw['amount'].PHP_EOL;
        }
    }

    public function viewBalance(){
        $totalDeposit = Deposit::total($this->customerEmail);
        $totalWithdraw = Withdraw::total($this->customerEmail);

        $balance = $totalDeposit - $totalWithdraw;

        print "Balance : " . $balance.PHP_EOL;
    }

    public function logout(){
        $this->customerEmail = '';
        print "Successfully logged out".PHP_EOL;
        $this->run();
    }

    
}