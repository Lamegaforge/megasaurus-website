<?php

namespace Tests\Feature;

use Tests\TestCase;

class ToggleAutoplayControllerTest extends TestCase
{
    /**
     * @test
     */
    public function it_able_to_redirect_to_the_previous_page(): void
    {
        $response = $this->from('clips')->get('toggle-autoplay');

        $response
            ->assertStatus(302)
            ->assertRedirect('clips');
    }

    /**
     * @test
     */
    public function it_able_to_toggle_to_true(): void
    {
        $response = $this->get('toggle-autoplay');

        $response->assertCookie('autoplay-cookie', '1');
    }

    /**
     * @test
     */
    public function it_able_to_toggle_to_false(): void
    {
        $response = $this->withCookie('autoplay-cookie', '1')->get('toggle-autoplay');

        $response->assertCookie('autoplay-cookie', '');
    }
}
