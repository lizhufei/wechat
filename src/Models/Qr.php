<?php


namespace Hsvisus\Wechat\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Qr extends Model
{
    use HasFactory;

    protected $table = 'qr';
    protected $guarded = [];

    /**
     * 生成二维码code
     * @param string $code
     * @return string
     */
    protected function generateCode(string $code='')
    {
        if (empty($code)){
            return md5(uniqid());
        }else{
            return base64_encode($code);
        }

    }
    /**
     * 生成二维码base64
     * @param int $size
     * @return string
     */
    protected function generateQR(string $content='', int $size=100,string $format='png',string $errLevel='M')
    {
        $qr = QrCode::errorCorrection($errLevel)
            ->format($format)
            ->size($size)
            ->encoding('UTF-8')
            ->generate($content);
        $qr_base64 = base64_encode($qr);

        return 'data:image/png;base64,' . $qr_base64;
    }

    /**
     * 获取二维码
     * @param int $appointment_id
     * @return false
     */
    protected function getQR(int $appointment_id)
    {
        $qr = $this->where('appointment_id', $appointment_id)->first();
        if ($qr){
            $appointment = Appointment::find($appointment_id);
            if ($this->isExpired($appointment->start, $appointment->end)){
                return $qr;
            }
            $qr->status = -1;
            $qr->save();
        }
        return false;
    }

    /**
     * 保存二维码
     * @param int $appointment_id
     * @return false|mixed|string
     */
    protected function storage(int $appointment_id)
    {
        $appointment = Appointment::find($appointment_id);
        $code = $this->generateCode();
        $this->appointment_id = $appointment_id;
        $this->code = $code;
        if ($this->isExpired($appointment->start, $appointment->end)){
            //正常时间范围
            $this->status = 1;
            $this->img = $this->generateQR($code);
        }
        $this->save();
        return $this->img??false;
    }

    /**
     * 判断时间是否过期
     * @param string $start
     * @param string $end
     * @return bool
     */
    public function isExpired(string $start, string $end):bool
    {
        $start = Carbon::parse($start);
        $end = Carbon::parse($end);
        $now = Carbon::now();
        return $now->gte($start) && $now->lte($end)
            ? true
            : false;
    }

}
