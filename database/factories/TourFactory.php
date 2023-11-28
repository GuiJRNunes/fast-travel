<?php

namespace Database\Factories;

use App\Utilities\Unsplash;
use App\Enum\TourStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tour>
 */
class TourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image_link' => Unsplash::generateRandomLink(),
            /* 'title' => fake()->text(50), */
            'title' => $this->generateTitle(),
            /* 'description' => fake()->realText(500), */
            'description' => $this->generateDescription(),
            'departure_date' => fake()->dateTimeInInterval('+1 days', '+60 days'),
            'return_date' => fake()->dateTimeInInterval('+61 days', '+121 days'),
            'capacity' => fake()->numberBetween(1, 50),
            'price_per_passenger' => fake()->randomFloat(2, 150, 600),
            'status' => TourStatusEnum::OPEN,
        ];
    }

    private function generateTitle(): string
    {
        /* Text generated with ChatGPT 
           Prompt: Write a title and a medium-sized summary for ten different fictional tour options for a travel agency */
        return match (fake()->randomDigit()) {
            0 => "Enchanted Europe: Mystical Castles and Folklore Tour",
            1 => "Safari Adventure: Wildlife Expedition in the Serengeti",
            2 => "Asian Delights: Culinary and Cultural Exploration",
            3 => "Expedition Antarctica: Discover the Frozen Continent",
            4 => "Mystical Wonders of South America: Inca Trails and Amazonian Adventure",
            5 => "Island Paradise Escapade: Caribbean Cruise Experience",
            6 => "Australian Outback Expedition: Red Desert and Aboriginal Heritage",
            7 => "Northern Lights Odyssey: Arctic Circle Adventure",
            8 => "Historical Gems of Egypt: Pyramids and Nile Expedition",
            9 => "Pacific Paradise: Polynesian Islands Discovery",
        };
    }

    private function generateDescription(): string
    {
        /* Text generated with ChatGPT 
           Prompt: Write a title and a medium-sized summary for ten different fictional tour options for a travel agency */
        return match (fake()->randomDigit()) {
            0 => "Embark on a captivating journey through Europe's ancient castles and folklore-rich destinations. Explore legendary sites like Bran Castle in Romania and Germany's Neuschwanstein Castle while delving into the enchanting tales and myths that have shaped these regions for centuries.",

            1 => "Experience the thrill of an authentic African safari in Tanzania's Serengeti National Park. Witness the breathtaking migration of wildebeests and zebras, encounter majestic lions, elephants, and giraffes in their natural habitat, and immerse yourself in the unparalleled beauty of the African wilderness.",

            2 => "Embark on a gastronomic and cultural odyssey across Asia's diverse landscapes. Indulge in delectable cuisines from Japan's sushi to Thailand's spicy delicacies, while discovering the rich heritage and traditions of each destination, from ancient temples to vibrant markets.",

            3 => "Journey to the southernmost continent and witness the pristine beauty of Antarctica. Cruise through icy waters, observe magnificent glaciers, and encounter unique wildlife such as penguins, seals, and whales, all while exploring one of the planet's most remote and untouched landscapes.",

            4 => "Uncover the ancient mysteries of South America as you trek the legendary Inca trails of Machu Picchu in Peru. Then, venture into the heart of the Amazon Rainforest, where exotic wildlife and indigenous cultures await in a breathtaking and immersive adventure.",

            5 => "Sail through the turquoise waters of the Caribbean Sea, hopping from one stunning island to another. Relax on white sandy beaches, snorkel in vibrant coral reefs, and soak up the vibrant culture and rhythms of the Caribbean islands.",

            6 => "Explore the rugged beauty of the Australian Outback, witnessing the iconic red desert landscapes and learning about the ancient traditions of Aboriginal culture. From Uluru to the Great Barrier Reef, this journey showcases the diverse wonders of Australia.",

            7 => "Embark on a mesmerizing journey to witness the ethereal Northern Lights in the Arctic Circle. Experience the magic of the Aurora Borealis while enjoying thrilling activities like husky sledding, snowshoeing, and exploring the unique Arctic wilderness.",

            8 => "Travel back in time to ancient Egypt's wonders, exploring iconic landmarks such as the Pyramids of Giza, the Sphinx, and Luxor's majestic temples. Cruise along the legendary Nile River, tracing the path of pharaohs and uncovering the secrets of this ancient civilization.",

            9 => "Embark on a tropical escapade through the picturesque islands of Polynesia. Experience the warmth of local hospitality, relax on stunning beaches, and discover the unique culture and traditions of Tahiti, Bora Bora, and Fiji amidst breathtaking natural beauty.",
        };
    }
}
