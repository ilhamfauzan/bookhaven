<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use App\Models\Transaction;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // user seeder default admin admin
        User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'address' => 'Jl. Jendral Sudirman No. 1',
            'email_verified_at' => now(),
            'password' => bcrypt('admin1234'),
            'is_admin' => true,
        ]);

        User::factory()->create([
            'name' => 'Ilham Fauzan',
            'username' => 'izan',
            'email' => 'i@zan.re',
            'address' => 'Jl. Gatot Subroto No. 9, Jakarta Selatan, DKI Jakarta 12950',
            'email_verified_at' => now(),
            'password' => bcrypt('admin1234'),
            'is_admin' => false,
        ]);

        Book::factory()->create([
            'title' => 'Harry Potter and the Chamber of Secrets',
            'author' => 'J.K. Rowling',
            'slug' => 'harry-potter-and-the-chamber-of-secrets',
            'description' => 'Ever since Harry Potter had come home for the summer, the Dursleys had been so mean and hideous that all Harry wanted was to get back to the Hogwarts School for Witchcraft and Wizardry. But just as he’s packing his bags, Harry receives a warning from a strange impish creature who says that if Harry returns to Hogwarts, disaster will strike. \n\n And strike it does. For in Harry’s second year at Hogwarts, fresh torments and horrors arise, including an outrageously stuck-up new professor and a spirit who haunts the girls’ bathroom. But then the real trouble begins – someone is turning Hogwarts students to stone. Could it be Draco Malfoy, a more poisonous rival than ever? Could it possibly be Hagrid, whose mysterious past is finally told? Or could it be the one everyone at Hogwarts most suspects… Harry Potter himself!',
            'category' => 'Fantasy',
            'price' => 100000,
            'stock' => 10,
            'image_url' => 'books/seed/harry-potter-and-the-chamber-of-secrets.jpg',
        ]);

        Book::factory()->create([
            'title' => 'Harry Potter and the Sorcerer\'s Stone',
            'author' => 'J.K. Rowling',
            'slug' => 'harry-potter-and-the-sorcerers-stone',
            'description' => 'Turning the envelope over, his hand trembling, Harry saw a purple wax seal bearing a coat of arms; a lion, an eagle, a badger and a snake surrounding a large letter H \n\n Harry Potter has never even heard of Hogwarts when the letters start dropping on the doormat at number four, Privet Drive. Addressed in green ink on yellowish parchment with a purple seal, they are swiftly confiscated by his grisly aunt and uncle. Then, on Harry\'s eleventh birthday, a great beetle-eyed giant of a man called Rubeus Hagrid bursts in with some astonishing news: Harry Potter is a wizard, and he has a place at Hogwarts School of Witchcraft and Wizardry. An incredible adventure is about to begin!',
            'category' => 'Fiction',
            'price' => 100000,
            'stock' => 10,
            'image_url' => 'books/seed/harry-potter-and-the-sorcerers-stone.jpg',
        ]);

        Book::factory()->create([
            'title' => 'Harry Potter and the Prisoner of Azkaban',
            'author' => 'J.K. Rowling',
            'slug' => 'harry-potter-and-the-prisoner-of-azkaban',
            'description' => 'Harry Potter, along with his best friends, Ron and Hermione, is about to start his third year at Hogwarts School of Witchcraft and Wizardry. Harry can\'t wait to get back to school after the summer holidays. (Who wouldn\'t if they lived with the horrible Dursleys?) But when Harry gets to Hogwarts, the atmosphere is tense. There\'s an escaped mass murderer on the loose, and the sinister prison guards of Azkaban have been called in to guard the school...',
            'category' => 'Fantasy',
            'price' => 100000,
            'stock' => 10,
            'image_url' => 'books/seed/harry-potter-and-the-prisoner-of-azkaban.jpg',
        ]);

        Book::factory()->create([
            'title' => 'Harry Potter and the Goblet of Fire',
            'author' => 'J.K. Rowling',
            'slug' => 'harry-potter-and-the-goblet-of-fire',
            'description' => 'The summer holidays are dragging on and Harry Potter can’t wait for the start of the school year. It is his fourth year at Hogwarts School of Witchcraft and Wizardry, and there are spells to be learned and (unfortunately) Potions and Divination lessons to be attended. But Harry can’t know that the atmosphere at Hogwarts is going to be charged with danger. Tension is in the air, and the Triwizard Tournament is about to begin.',
            'category' => 'Fiction',
            'price' => 100000,
            'stock' => 10,
            'image_url' => 'books/seed/harry-potter-and-the-goblet-of-fire.jpg',
        ]);

        Book::factory()->create([
            'title' => 'Harry Potter and the Order of the Phoenix',
            'author' => 'J.K. Rowling',
            'slug' => 'harry-potter-and-the-order-of-the-phoenix',
            'description' => 'The Hogwarts High Inquisitor is interfering with the classes, and nobody in authority seems to know how to stop her. To make matters worse, the Ministry of Magic has started interfering at Hogwarts, and none of the teachers seem to remember the danger of the wizarding world.',
            'category' => 'Fantasy',
            'price' => 100000,
            'stock' => 10,
            'image_url' => 'books/seed/harry-potter-and-the-order-of-the-phoenix.jpg',
        ]);

        Transaction::factory()->create([
            'user_id' => 1,
            'book_id' => 1,
            'quantity' => 1,
            'total_price' => 100000,
            'payment_status' => 'Paid',
            'transaction_status' => 'Processing',
            'transaction_date' => now(),
            'address' => 'Jl. Jendral Sudirman No. 1',
            'shipping_status' => 'Delivered',
            'payment_method' => 'QRIS',
        ]);

        Transaction::factory()->create([
            'user_id' => 2,
            'book_id' => 3,
            'quantity' => 1,
            'total_price' => 100000,
            'payment_status' => 'Paid',
            'transaction_status' => 'Processing',
            'transaction_date' => now(),
            'address' => 'Jl. Jendral Sudirman No. 1',
            'shipping_status' => 'Delivered',
            'payment_method' => 'QRIS',
        ]);


    }
}
