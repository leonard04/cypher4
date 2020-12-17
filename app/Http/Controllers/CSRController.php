<?php

namespace App\Http\Controllers;

use App\Helpers\FileManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use DB;
use App\Models\Qhse_csr_main;

class CSRController extends Controller
{
    public function index(){
        $csr = Qhse_csr_main::where('company_id', \Session::get('company_id'))->get();
        return view('csr.index',[
            'csr' => $csr,
        ]);
    }

    public function publishCSR(Request $request){
        if (isset($request['publish'])){
            Qhse_csr_main::where('id', $request['id'])
                ->update([
                    'online' => 1
                ]);
        }
        if (isset($request['unpublish'])){
            Qhse_csr_main::where('id', $request['id'])
                ->update([
                    'online' => 0
                ]);
        }

        return redirect()->route('csr.index');
    }

    public function delete($id){
        Qhse_csr_main::where('id', $id)->delete();
        return redirect()->route('csr.index');
    }
    public function storeCSR(Request $request){
        if (isset($request['edit'])){
            Qhse_csr_main::where('id', $request['edit'])
                ->update([
                    'date' => $request['event_schedule'],
                    'title' => $request['title'],
                    'deskripsi' => $request['description'],
                    'division' => $request['division'],
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            if ($request->hasFile('image1')){
                $file = $request->file('image1');
                $newFile = date('Y_m_d_H_i_s')."csr_image1.".$file->getClientOriginalExtension();

                $hashFile = Hash::make($newFile);
                $hashFile = str_replace("/", "", $hashFile);

                $upload = FileManagement::save_file_management($hashFile, $file, $newFile, "media/csr_attachment");
                if ($upload == 1){
                    Qhse_csr_main::where('id', $request['edit'])
                        ->update([
                            'pict1' => $newFile,
                        ]);
                }
            }
            if ($request->hasFile('image2')){
                $file = $request->file('image2');
                $newFile = date('Y_m_d_H_i_s')."csr_image2.".$file->getClientOriginalExtension();

                $hashFile = Hash::make($newFile);
                $hashFile = str_replace("/", "", $hashFile);

                $upload = FileManagement::save_file_management($hashFile, $file, $newFile, "media/csr_attachment");
                if ($upload == 1){
                    Qhse_csr_main::where('id', $request['edit'])
                        ->update([
                            'pict2' => $newFile,
                        ]);
                }
            }
            if ($request->hasFile('image3')){
                $file = $request->file('image3');
                $newFile = date('Y_m_d_H_i_s')."csr_image3.".$file->getClientOriginalExtension();

                $hashFile = Hash::make($newFile);
                $hashFile = str_replace("/", "", $hashFile);

                $upload = FileManagement::save_file_management($hashFile, $file, $newFile, "media/csr_attachment");
                if ($upload == 1){
                    Qhse_csr_main::where('id', $request['edit'])
                        ->update([
                            'pict3' => $newFile,
                        ]);
                }
            }
            if ($request->hasFile('image4')){
                $file = $request->file('image4');
                $newFile = date('Y_m_d_H_i_s')."csr_image4.".$file->getClientOriginalExtension();

                $hashFile = Hash::make($newFile);
                $hashFile = str_replace("/", "", $hashFile);

                $upload = FileManagement::save_file_management($hashFile, $file, $newFile, "media/csr_attachment");
                if ($upload == 1){
                    Qhse_csr_main::where('id', $request['edit'])
                        ->update([
                            'pict4' => $newFile,
                        ]);
                }
            }
            if ($request->hasFile('image5')){
                $file = $request->file('image5');
                $newFile = date('Y_m_d_H_i_s')."csr_image5.".$file->getClientOriginalExtension();

                $hashFile = Hash::make($newFile);
                $hashFile = str_replace("/", "", $hashFile);

                $upload = FileManagement::save_file_management($hashFile, $file, $newFile, "media/csr_attachment");
                if ($upload == 1){
                    Qhse_csr_main::where('id', $request['edit'])
                        ->update([
                            'pict5' => $newFile,
                        ]);
                }
            }
        } else {

            $csr = new Qhse_csr_main();
            $csr->author = Auth::user()->username;
            $csr->date = $request['event_schedule'];
            $csr->title = $request['title'];
            $csr->deskripsi = $request['description'];
            $csr->online = 0;
            $csr->company_id = \Session::get('company_id');
            $csr->division = $request['division'];
            $csr->created_at = date('Y-m-d H:i:s');

            if ($request->hasFile('image1')){
                $file = $request->file('image1');
                $newFile = date('Y_m_d_H_i_s')."csr_image1.".$file->getClientOriginalExtension();

                $hashFile = Hash::make($newFile);
                $hashFile = str_replace("/", "", $hashFile);

                $upload = FileManagement::save_file_management($hashFile, $file, $newFile, "media/csr_attachment");
                if ($upload == 1){
                    $csr->pict1 = $newFile;
                }
            }
            if ($request->hasFile('image2')){
                $file = $request->file('image2');
                $newFile = date('Y_m_d_H_i_s')."csr_image2.".$file->getClientOriginalExtension();

                $hashFile = Hash::make($newFile);
                $hashFile = str_replace("/", "", $hashFile);

                $upload = FileManagement::save_file_management($hashFile, $file, $newFile, "media/csr_attachment");
                if ($upload == 1){
                    $csr->pict2 = $newFile;
                }
            }
            if ($request->hasFile('image3')){
                $file = $request->file('image3');
                $newFile = date('Y_m_d_H_i_s')."csr_image3.".$file->getClientOriginalExtension();

                $hashFile = Hash::make($newFile);
                $hashFile = str_replace("/", "", $hashFile);

                $upload = FileManagement::save_file_management($hashFile, $file, $newFile, "media/csr_attachment");
                if ($upload == 1){
                    $csr->pict3 = $newFile;
                }
            }
            if ($request->hasFile('image4')){
                $file = $request->file('image4');
                $newFile = date('Y_m_d_H_i_s')."csr_image4.".$file->getClientOriginalExtension();

                $hashFile = Hash::make($newFile);
                $hashFile = str_replace("/", "", $hashFile);

                $upload = FileManagement::save_file_management($hashFile, $file, $newFile, "media/csr_attachment");
                if ($upload == 1){
                    $csr->pict4 = $newFile;
                }
            }
            if ($request->hasFile('image5')){
                $file = $request->file('image5');
                $newFile = date('Y_m_d_H_i_s')."csr_image5.".$file->getClientOriginalExtension();

                $hashFile = Hash::make($newFile);
                $hashFile = str_replace("/", "", $hashFile);

                $upload = FileManagement::save_file_management($hashFile, $file, $newFile, "media/csr_attachment");
                if ($upload == 1){
                    $csr->pict5 = $newFile;
                }
            }
            $csr->save();
        }

        return redirect()->route('csr.index');

    }
}
