<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface ControllerInterface
{
    public function index();

    public function store(Request $request);

    public function show(Request $request);

    public function update(Request $request, string $id);

    public function destroy(string $id);
}
