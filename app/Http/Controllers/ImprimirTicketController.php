<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;


class ImprimirTicketController extends Controller
{
    public function imprimirCuota()
    {
        // Orden
        $sede = Auth::user();
        var_dump($sede);
        exit;
        // Información empresarial
        $configuration = new Configuration();
        $company =  $configuration->select()->first();

        if (!$company->printer || $company->printer == '') {
            return false;
        }

        // Config de impresora
        $connector = new WindowsPrintConnector($company->printer);

        try {

            $printer = new Printer($connector);
            $printer->initialize();
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            try {
                $logo = EscposImage::load($company->logo, false);
                $printer->bitImage($logo);
            } catch (Exception $e) {
                /* Images not supported on your PHP, or image file not found */
                //$printer->text($e->getMessage() . "\n");
            }

            $printer->setTextSize(1, 2);
            $printer->setEmphasis(true);
            $printer->text($company->name . "\n");
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->setTextSize(1, 1);
            $printer->setEmphasis(false);
            $printer->text("NIT: ");
            $printer->text($company->nit . "\n");
            $printer->text("Dirección: ");
            $printer->text($company->address . "\n");

            $printer->setEmphasis(true);
            $printer->text("Cajero(a): ");
            $printer->text($system_user->name . "\n");
            $printer->setEmphasis(false);
            $printer->text("Fecha: ");
            $printer->text(date('Y-m-d h:i:s A') .  "\n");
            $printer->text("N° Factura: ");
            $printer->text($order->id . "\n");        // 
            $printer->text("Cliente: ");
            $printer->text($order->client->name . "\n");
            $printer->setLineSpacing(2);
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("\n-----------------------------------------" . "\n\n");
            $printer->setLineSpacing(1);
            $printer->setEmphasis(true);
            $printer->text(sprintf('%-22s %+8s %+10.7s', 'ARTICULO', 'CANT', 'PRECIO'));
            $printer->text("\n-----------------------------------------" . "\n\n");
            $printer->setEmphasis(false);
            $printer->text("\n");
            $total = 0;
            foreach ($order_details as $df) {
                $line = sprintf('%-22s %8.2f %10.2f ', '-' . mb_strimwidth($df->product, 0, 21, ''), $df->quantity, $df->price_tax_inc_total);
                $total +=  $df->price_tax_inc_total;
                $printer->text($line);
                $printer->text("\n");
            }
            $printer->text("\n==========================================" . "\n");
            $printer->setEmphasis(true);
            $printer->setLineSpacing(2);
            $printer->text("\n");
            $printer->text(sprintf('%-25s %+15.15s', 'Subtotal', number_format($order->total_iva_exc, 2), '.', ','));
            $printer->text("\n");
            $printer->text(sprintf('%-25s %+15.15s', 'Iva', number_format($order->total_iva_inc - $order->total_iva_exc, 2, '.', ',')));
            $printer->text("\n");
            $printer->setTextSize(1, 2);
            $printer->text(sprintf('%-25s %+15.15s', 'TOTAL', number_format($total, 2, '.', ',')));
            $printer->setTextSize(1, 1);
            $printer->setEmphasis(false);
            if ($cash != null && $change != null) {
                $printer->text("\n");
                $printer->text(sprintf('%-25s %+15.15s', 'Efectivo', number_format($cash, 2, '.', ',')));
                $printer->text("\n");
                $printer->text(sprintf('%-25s %+15.15s', 'Cambio', number_format($change, 2, '.', ',')));
            }
            $printer->text("\n");
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->setLineSpacing(2);
            $printer->setEmphasis(false);
            $printer->setFont(Printer::MODE_FONT_B);
            $printer->text($company->condition_order . "\n");
            $printer->text("Tecnoplus");
            $printer->text("\nwww.tecnoplus.com\n");
            $printer->cut();
            $printer->pulse();
            $printer->close();

            return redirect()->back()->with("mensaje", "Ticket impreso");
        } catch (\Throwable $th) {
            return false;
        }
    }
}
