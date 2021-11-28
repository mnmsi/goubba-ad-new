<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class PreviewController extends Controller
{
    public function preview(Request $request)
    {
        if ($request->type == 'native') {

            $url  = $request->file->store('public/temp/' . Auth::user()->id);
            $logo = $request->logo->store('public/temp/' . Auth::user()->id);

            $file_path = str_replace('public', 'storage', asset($url));
            $logo_path = str_replace('public', 'storage', asset($logo));

            $data = array(
                'type'     => $request->type,
                'title'    => $request->title,
                'file'     => $file_path,
                'logo'     => $logo_path,
                'position' => $request->position,
                'link'     => $request->link,
            );

        } elseif ($request->type == 'story') {

            $url = $request->file->store('public/temp/' . Auth::user()->id);

            $file_path = str_replace('public', 'storage', asset($url));

            $data = array(
                'type'  => $request->type,
                'title' => $request->title,
                'file'  => $file_path,
                'link'  => $request->link,
            );
        } elseif ($request->type == 'banner') {

            $url = $request->file->store('public/temp/' . Auth::user()->id);

            $file_path = str_replace('public', 'storage', asset($url));

            $data = array(
                'type'     => $request->type,
                'file'     => $file_path,
                'position' => $request->position,
                'link'     => $request->link,
            );

        } elseif ($request->type == 'home_banner') {

            $url = $request->file->store('public/temp/' . Auth::user()->id);

            $file_path = str_replace('public', 'storage', asset($url));

            $data = array(
                'type'     => $request->type,
                'file'     => $file_path,
                'position' => $request->position,
                'link'     => $request->link,
            );
        }

        session()->put('adPreviewData', $data);
        return response()->json(['alert' => 'success']);
    }

    public function previewShow()
    {
        $data = session()->get('adPreviewData');

        if (empty($data)) {
            $data = [];
        }

        // return view('pages.preview.previewAd', $data);
        return view('pages.preview.previewAdDiv', $data);
    }

    public function previewEdit(Request $request)
    {
        if ($request->type == 'native') {

            $data = array(
                'type'     => $request->type,
                'title'    => $request->title,
                'file'     => $request->file,
                'logo'     => $request->logo,
                'position' => $request->position,
                'link'     => $request->link,
            );

        } elseif ($request->type == 'story') {

            $data = array(
                'type'  => $request->type,
                'title' => $request->title,
                'file'  => $request->file,
                'link'  => $request->link,
            );
        } elseif ($request->type == 'banner') {

            $data = array(
                'type'     => $request->type,
                'file'     => $request->file,
                'position' => $request->position,
                'link'     => $request->link,
            );
        } elseif ($request->type == 'home_banner') {

            $data = array(
                'type'     => $request->type,
                'file'     => $request->file,
                'position' => $request->position,
                'link'     => $request->link,
            );
        }

        session()->put('adPreviewEditData', $data);
        return response()->json(['alert' => 'success']);
    }

    public function previewShowEdit()
    {
        $data = session()->get('adPreviewEditData');

        // return view('pages.preview.previewAd', $data);
        return view('pages.preview.previewAdDiv', $data);
    }

    public function previewEditNewAd(Request $request)
    {
        if ($request->type == 'native') {

            $url       = $request->file->store('public/temp/' . Auth::user()->id);
            $file_path = str_replace('public', 'storage', asset($url));

            if (is_file($request->logo) && !is_string($request->logo)) {
                $logo      = $request->logo->store('public/temp/' . Auth::user()->id);
                $logo_path = str_replace('public', 'storage', asset($logo));
            } else {
                $logo_path = $request->logo;
            }

            $data = array(
                'type'     => $request->type,
                'title'    => $request->title,
                'file'     => $file_path,
                'logo'     => $logo_path,
                'position' => $request->position,
                'link'     => $request->link,
            );

        } elseif ($request->type == 'story') {

            $url = $request->file->store('public/temp/' . Auth::user()->id);

            $file_path = str_replace('public', 'storage', asset($url));

            $data = array(
                'type'  => $request->type,
                'title' => $request->title,
                'file'  => $file_path,
                'link'  => $request->link,
            );
        } elseif ($request->type == 'banner') {

            $url = $request->file->store('public/temp/' . Auth::user()->id);

            $file_path = str_replace('public', 'storage', asset($url));

            $data = array(
                'type'     => $request->type,
                'file'     => $file_path,
                'position' => $request->position,
                'link'     => $request->link,
            );
        }

        session()->put('adPreviewData', $data);
        return response()->json(['alert' => 'success']);
    }

    public function previewShowEditNewAd()
    {
        $data = session()->get('adPreviewData');

        return view('pages.preview.previewAd', $data);
    }

    public function previewAllAds(Request $request)
    {
        if ($request->type == 'native') {

            $title    = $request->title;
            $file     = $request->file;
            $logo     = $request->logo;
            $position = $request->position;
            $link     = $request->link;

            $data         = array();
            $data['type'] = $request->type;

            foreach ($request->position as $key => $value) {

                $data['native'][] = [
                    'title'    => $title[$key],
                    'file'     => $file[$key],
                    'logo'     => $logo[$key],
                    'position' => $position[$key],
                    'link'     => $link[$key],
                ];
            }

            session()->put('nativeAdsPreviewData', $data);

        }

        if ($request->type == 'story') {

            $title = $request->title;
            $file  = $request->file;
            $link  = $request->link;

            $data         = array();
            $data['type'] = $request->type;

            foreach ($file as $key => $value) {

                $data['story'][] = [
                    'title' => $title[$key],
                    'file'  => $file[$key],
                    'link'  => $link[$key],
                ];
            }

            session()->put('storyAdsPreviewData', $data);
        }

        if ($request->type == 'banner') {

            $file     = $request->file;
            $position = $request->position;
            $link     = $request->link;

            $data         = array();
            $data['type'] = $request->type;

            foreach ($file as $key => $value) {

                $data['banner'][] = [
                    'file'     => $file[$key],
                    'position' => $position[$key],
                    'link'     => $link[$key],
                ];
            }

            session()->put('bannerAdsPreviewData', $data);
        }

        if ($request->type == 'home_banner') {

            $file     = $request->file;
            $position = $request->position;
            $link     = $request->link;

            $data         = array();
            $data['type'] = $request->type;

            foreach ($file as $key => $value) {

                $data['home_banner'][] = [
                    'file'     => $file[$key],
                    'position' => $position[$key],
                    'link'     => $link[$key],
                ];
            }

            session()->put('homeBannerAdsPreviewData', $data);
        }

        return response()->json(['alert' => 'success']);
    }

    public function previewShowAllAds(Request $request)
    {
        $data['nativeAd'] = session()->get('nativeAdsPreviewData');
        $data['storyAd'] = session()->get('storyAdsPreviewData');
        $data['bannerAd'] = session()->get('bannerAdsPreviewData');
        $data['homeBannerAd'] = session()->get('homeBannerAdsPreviewData');

        return view('pages.preview.previewAdAll', $data);
    }
}
