<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    public function definition(): array
    {
        $locations = [
            'Istanbul', 'Ankara', 'Izmir', 'Bursa', 'Adana', 'Gaziantep',
            'Konya', 'Antalya', 'Kayseri', 'Mersin', 'Diyarbakır', 'Samsun',
            'Eskişehir', 'Denizli', 'Trabzon', 'Erzurum', 'Malatya', 'Sakarya',
            'Manisa', 'Balıkesir',
        ];

        $status = $this->faker->randomElement(['pending', 'under_review', 'approved', 'rejected']);
        $rejectionReason = $status === 'rejected' ? $this->faker->sentence() : null;

        return [
            'user_id' => User::factory(),
            'profile_id' => function (array $attributes) {
                return 'ID-' . str_pad($attributes['user_id'], 8, '0', STR_PAD_LEFT);
            },
            'phone_number' => $this->faker->phoneNumber(),
            'company_name' => $this->faker->company(),
            'company_location' => $this->faker->randomElement($locations),
            'job_title' => $this->faker->jobTitle(),
            'date_of_birth' => $this->faker->date('Y-m-d', '-20 years'),
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'profile_image' => $this->faker->imageUrl(300, 300, 'people'),
            'address' => $this->faker->address(),
            'timezone' => $this->faker->timezone(),
            'bio' => $this->faker->paragraph(),
            'notification_preferences' => [
                'email' => true,
                'sms' => false,
            ],
            'last_login_at' => now()->subDays(rand(1, 30)),
            'verified' => $this->faker->boolean(80),
            'status' => $status,
            'rejection_reason' => $rejectionReason,
            'is_active' => $this->faker->boolean(70), // 70% chance of true
        ];
    }
}
