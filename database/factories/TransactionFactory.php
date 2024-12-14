<?php

namespace Database\Factories;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 2),
            'book_id' => $this->faker->numberBetween(1, 4),
            'quantity' => $this->faker->numberBetween(1, 3),
            'total_price' => $this->faker->numberBetween(50000, 150000),
            'payment_status' => $this->faker->randomElement(['Pending', 'Paid', 'Failed']),
            'transaction_status' => $this->faker->randomElement(['Processing', 'Cancelled', 'Completed', 'Delivered']),
            'transaction_date' => $this->faker->dateTimeThisYear(),
            'address' => $this->faker->address,
            'payment_method' => $this->faker->randomElement(['Bank Transfer', 'QRIS', 'Debit / Credit Card', 'Virtual Account', 'Cash']),
            'shipping_status' => $this->faker->randomElement(['Processing', 'Shipped', 'Delivered']),
        ];
    }
}