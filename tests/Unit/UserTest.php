<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use ReflectionMethod;
use Tests\TestCase;

final class UserTest extends TestCase
{
    public function test_get_orders_method_exists(): void
    {
        $user = new User;

        $this->assertTrue(method_exists($user, 'getOrders'));
        $this->assertTrue(method_exists($user, 'orders'));

        $reflection = new ReflectionMethod($user, 'getOrders');
        $returnType = $reflection->getReturnType();

        $this->assertNotNull($returnType);
        $this->assertEquals(Collection::class, $returnType->getName());
    }

    public function test_get_orders_has_correct_structure(): void
    {
        $user = new User;

        $this->assertTrue(method_exists($user, 'getOrders'));

        $reflection = new ReflectionMethod($user, 'getOrders');
        $this->assertTrue($reflection->isPublic());

        $returnType = $reflection->getReturnType();
        $this->assertNotNull($returnType);
        $this->assertEquals(Collection::class, $returnType->getName());
    }
}
