<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AuthenticationTest extends DuskTestCase
{

    private $elements = [
        'loginButton' => '#ui-test-login-button',
        'logoutButton' => '#ui-test-logout-button',
        'menuButton' => '#ui-test-menu-button',
    ];

    private $urls = [
        'dashboard' => '/dashboard'
    ];

    public function testUILoginLandingPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->waitFor($this->elements['loginButton']);
        });
    }

    public function testUIFailedLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->waitFor($this->elements['loginButton'])
                ->type('email', 'unknown@example.org')
                ->type('password', 'invalid-password')
                ->click($this->elements['loginButton'])
                ->assertSee('AUTH: Failed to login! Email and password does not match!');
        });
    }

    public function testUISuccessLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->waitFor($this->elements['loginButton'])
                ->type('email', 'test.user@teleoutsourcing.co.uk')
                ->type('password', 'secret')
                ->click($this->elements['loginButton'])
                ->assertPathIs($this->urls['dashboard'])
                ->click($this->elements['menuButton'])
                ->click($this->elements['logoutButton']);
        });
    }

    public function testUISuccessLogout()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->waitFor($this->elements['loginButton'])
                ->type('email', 'test.user@teleoutsourcing.co.uk')
                ->type('password', 'secret')
                ->click($this->elements['loginButton'])
                ->assertPathIs($this->urls['dashboard'])
                ->click($this->elements['menuButton'])
                ->click($this->elements['logoutButton'])
                ->waitFor($this->elements['loginButton']);
        });
    }

    public function testUIThrottle()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->waitFor($this->elements['loginButton'])
                ->type('email', 'test.user@teleoutsourcing.co.uk')
                ->type('password', 'invalidpassword')
                ->click($this->elements['loginButton'])
                ->type('email', 'test.user@teleoutsourcing.co.uk')
                ->type('password', 'invalidpassword')
                ->click($this->elements['loginButton'])
                ->type('email', 'test.user@teleoutsourcing.co.uk')
                ->type('password', 'invalidpassword')
                ->click($this->elements['loginButton'])
                ->type('email', 'test.user@teleoutsourcing.co.uk')
                ->type('password', 'invalidpassword')
                ->click($this->elements['loginButton'])
                ->type('email', 'test.user@teleoutsourcing.co.uk')
                ->type('password', 'invalidpassword')
                ->click($this->elements['loginButton'])
                ->type('email', 'test.user@teleoutsourcing.co.uk')
                ->type('password', 'invalidpassword')
                ->click($this->elements['loginButton'])
                ->assertSee('AUTH: Your account has been locked for too many attempts. Try again later.');
        });

    }
}
