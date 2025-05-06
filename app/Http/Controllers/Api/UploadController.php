<?php
namespace App\Http\Controllers\Api;

use App\Helpers\DocumentParser;
use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class UploadController extends Controller {
    public function upload(Request $req) {
        $req->validate([
            'documents'   => 'required|array|min:1',
            'documents.*' => 'file|mimes:pdf,txt,md,doc,docx|max:10240',
        ]);

        foreach ($req->file('documents') as $file) {
            $text = DocumentParser::extractText($file);
            if (!trim($text)) {
                continue;
            }

            Document::create([
                'filename'     => $file->getClientOriginalName(),
                'content'      => $text,
                'metadata'     => json_encode(['preview' => substr($text, 0, 200)]),
                'processed_at' => now(),
            ]);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'All documents stored in database.',
        ]);
    }
}
