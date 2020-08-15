<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class HTTPTest extends TestCase
{
    /** @test */
    public function getIndexPageTest()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /** @test */
    public function getHomePageTest()
    {
        $response = $this->get('/home');
        $response->assertStatus(200);
    }

    /** @test */
    public function getAboutPageTest()
    {
        $response = $this->get('/about');
        $response->assertStatus(200);
    }


    /** This test is used to verify a user a redirected to the login
     * if they attempt to access the rent a locker page without
     * being authenticated
     */
    /** @test */
    public function getRentalPageWithoutLoginTest()
    {
        $response = $this->get('/rent');

        $response->assertRedirect('/login');
    }

    /** This test is used to verify that the admin dashboard page
     * does not work without authentication
     */
    /** @test */
    public function adminPageWithoutAdminRightsTest()
    {
        $response = $this->get('/admin/dashboard');

        $response->assertRedirect('/login');
    }

    /** This test is used to verify that accessing the rental page
     * as a user works
     */
    /** @test */
    public function rentalPageAsUserTest()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('/rent');

        $response->assertStatus(200);
    }

    /** This test is used to verify that accessing the rental page
     * as a user works
     */
    /** @test */
    public function adminDashboardAsAdmin()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(200);
    }
}
