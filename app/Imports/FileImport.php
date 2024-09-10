<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Merchandise;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shipment;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;

class FileImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    use RemembersRowNumber;

    public function collection(Collection $rows)
    {
        $currentRowNumber = $this->getRowNumber();
        $previous_class_code  = '';
        $previous_car_code  = '';
        foreach ($rows as $index => $row) {

            if ((empty(trim($row['ma_so_thungbao'])) && empty(trim($row['ma_xe'])) && empty($row['ma_phan_loai']))
                || ($row['ma_so_thungbao'] == null && $row['ma_xe'] == null && $row['ma_phan_loai'] == null)
            ) {
                return null;
            }

            $merchandise = Merchandise::create([
                'code' => trim($row['ma_so_thungbao']),
                'count' => (int)trim($row['so_luong_thungbaokien'])
            ]);

            if ($previous_car_code != trim($row['ma_xe']))
                $shipment = Shipment::create([
                    'car_code' => trim($row['ma_xe']),
                    'is_end' => false
                ]);

            if ($previous_class_code != trim($row['ma_phan_loai']))
                $order = Order::create([
                    'class_code' => trim($row['ma_phan_loai']),
                    'result' => false,
                    'address' => trim($row['dia_chi_giao_hang']),
                    'shipment_id' => $shipment->id
                ]);

            $order_detail = OrderDetail::create([
                'order_id' => $order->id,
                'merchandise_id' => $merchandise->id,

            ]);

            $previous_class_code = trim($row['ma_phan_loai']);
            $previous_car_code = trim($row['ma_xe']);
        }
    }

    public function chunkSize(): int
    {
        return 100; // Import 100 bản ghi mỗi lần
    }
}
