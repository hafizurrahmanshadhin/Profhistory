<?php
namespace App\Services\Api;

use Illuminate\Support\Facades\Http;

class PineconeService {
    protected static function headers(): array {
        return [
            'Api-Key'      => config('services.pinecone.key'),
            'Content-Type' => 'application/json',
        ];
    }

    protected static function baseUrl(): string {
        return rtrim(config('services.pinecone.base_url'), '/');
    }

    /**
     * Upsert a batch of vectors and return their IDs in the same order.
     * @param  array[]  $vectors  list of embeddings
     * @param  string[] $texts    corresponding text snippets
     * @return string[]  vector IDs
     */
    public static function storeBatchEmbeddings(array $vectors, array $texts): array {
        $vectorsPayload = [];
        $ids            = [];
        foreach ($vectors as $i => $vec) {
            $id               = uniqid('vec_');
            $ids[]            = $id;
            $vectorsPayload[] = [
                'id'       => $id,
                'values'   => $vec,
                'metadata' => ['text' => $texts[$i]],
            ];
        }

        $payload = ['vectors' => $vectorsPayload];
        Http::withHeaders(static::headers())
            ->timeout(60)
            ->post(static::baseUrl() . '/vectors/upsert', $payload)
            ->throw();

        return $ids;
    }
}
