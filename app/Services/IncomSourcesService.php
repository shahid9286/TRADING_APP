<?php

namespace App\Services;

use App\Models\IncomSources;

class IncomSourcesService
{
    public function IncomSourcesIndex()
    {
        return IncomSources::all();
    }
    public function IncomSourcesStore($data)
    {
        IncomSources::create($data);
    }
    public function IncomSourcesEdit($id)
    {
        return IncomSources::findorfail($id);
    }
    public function IncomSourcesUpdate($data, $id)
    {
        $IncomSources = IncomSources::findorfail($id);
        $IncomSources->update($data);
    }
    public function IncomSourcesDelete($id)
    {
        $IncomSources = IncomSources::findorfail($id);
        $IncomSources->delete();
    }
}
