<?php

namespace App\Http\Livewire\Hotels\Entry;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Downloads extends Component
{
    public function download($type)
    {
        if($type === '가이드라인'){
            $filename='[호텔에삶]호텔 가이드라인-v2021.06.14.pdf';
            /*$headers = [
                'Content-Type: application/octet-stream',
                'Content-Disposition: attachment; filename='.iconv('UTF-8','CP949',$filename),
                'Content-Transfer-Encoding: binary',
                'Content-Length:'.Storage::disk('s3')->size('/downloads/enter/Guidelines-2021.06.14.pdf'),
                'Pragma: no-cache',
                'Expires: 0',
                'Content-Type: application/pdf',
            ];*/
            /*return response()->streamDownload(function() {
                echo Storage::disk('s3')->download('/downloads/enter/Guidelines-2021.06.14.pdf');
            }, 'livinginhotel_Guidelines-2021.06.14.pdf');*/
            //return response()->download('https://d2pyzcqibfhr70.cloudfront.net/downloads/enter/Guidelines-2021.06.14.pdf');
            return Storage::disk('s3')->download('/downloads/enter/Guidelines-2021.06.14.pdf', 'livinginhotel_Guidelines-2021.06.14.pdf');
        }
    }
	public function render()
	{
		return view('livewire.hotels.entry.downloads');
	}
}
