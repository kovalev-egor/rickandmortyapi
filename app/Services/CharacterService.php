<?php

namespace App\Services;

class CharacterService
{
    public function __construct(
        private readonly RickAndMortyApi $rickAndMortyApi
    )
    {
    }

    public function getListByEpisodeId(int $episodeId): ?array
    {
        $episode = $this->rickAndMortyApi->get("episode/$episodeId");

        if (!$episode) return null;

        $characters = $this->rickAndMortyApi->get("character/{$this->getImplodedCharacterIds($episode['characters'])}");

        return $characters ? array_map(fn ($character) => $this->formatCharacter($character), $characters) : null;
    }

    private function getImplodedCharacterIds(array $characters): string
    {
        $ids = [];

        foreach ($characters as $character) {
            $explodedCharacterUrl = explode('/', $character);
            $ids[] = array_pop($explodedCharacterUrl);
        }

        return implode(',', $ids);
    }

    private function formatCharacter(array $character): array
    {
        $explodedLocationUrl = explode('/', $character['location']['url']);

        return [
            'id' => $character['id'],
            'name' => $character['name'],
            'gender' => $character['gender'],
            'image' => $character['image'],
            'locationId' => array_pop($explodedLocationUrl)
        ];
    }
}