<?php

require_once dirname(dirname(__FILE__)).'/tcpdf/tcpdf_barcodes_2d.php';

class modTCPDF2DBarcode extends modProcessor
{
    // temporary config initiation
    public function process()
    {

        /*
            Parameters
                $code    (string) code to print
                $type	(string) type of barcode:
                    DATAMATRIX : Datamatrix (ISO/IEC 16022)
                    PDF417 : PDF417 (ISO/IEC 15438:2006)
                    PDF417,a,e,t,s,f,o0,o1,o2,o3,o4,o5,o6 : PDF417 with parameters: a = aspect ratio (width/height); e = error correction level (0-8); t = total number of macro segments; s = macro segment index (0-99998); f = file ID; o0 = File Name (text); o1 = Segment Count (numeric); o2 = Time Stamp (numeric); o3 = Sender (text); o4 = Addressee (text); o5 = File Size (numeric); o6 = Checksum (numeric). NOTES: Parameters t, s and f are required for a Macro Control Block, all other parametrs are optional. To use a comma character ',' on text options, replace it with the character 255: "\xff".
                    QRCODE : QRcode Low error correction
                    QRCODE,L : QRcode Low error correction
                    QRCODE,M : QRcode Medium error correction
                    QRCODE,Q : QRcode Better error correction
                    QRCODE,H : QR-CODE Best error correction
                    RAW: raw mode - comma-separad list of array rows
                    RAW2: raw mode - array rows are surrounded by square parenthesis.
                    TEST : Test matrix
        */

        $this->_type = ($params = $this->modx->getOption('modtcpdf.2dbarcode_type')) ? $params : 'PDF417';
    }

    public function get($text, array $arguments = array(), $type = '', $callback = 'getBarcodeSVGcode')
    {
        $this->process();

        $code = new TCPDF2DBarcode($text, $type ? $type : $this->_type);

        return call_user_func_array(array($code, $callback), $arguments);
    }
}
