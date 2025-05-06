<?php
namespace App\Helpers;

use PhpOffice\PhpWord\IOFactory;
use Smalot\PdfParser\Parser;

class DocumentParser {
    public static function extractText($file) {
        $ext = strtolower($file->getClientOriginalExtension());

        if ($ext === 'pdf') {
            $parser = new Parser();
            return $parser->parseFile($file->getPathname())->getText();
        }

        if (in_array($ext, ['txt', 'md'])) {
            return file_get_contents($file->getPathname());
        }

        if (in_array($ext, ['doc', 'docx'])) {
            $phpWord = IOFactory::load($file->getPathname());
            $text    = '';
            foreach ($phpWord->getSections() as $sec) {
                foreach ($sec->getElements() as $el) {
                    if (method_exists($el, 'getText')) {
                        $text .= $el->getText() . "\n";
                    }
                }
            }
            return $text;
        }

        return '';
    }
}
