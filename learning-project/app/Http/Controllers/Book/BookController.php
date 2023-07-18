<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\BookDestroyRequest;
use App\Http\Requests\Book\BookShowRequest;
use App\Http\Requests\Book\BookStoreRequest;
use App\Http\Requests\Book\BookUpdateRequest;
use App\Http\Resources\Book\BookResource;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): BookResource
    {
        return new BookResource((object)[
            'id' => 0,
            'name' => 'Neuromancer',
            'author' => 'William Gibson',
            'year' => 1984,
            'countPages' => 700,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookStoreRequest $request): BookResource
    {
        $validatedData = $request->validated();
        //обробляємо отримані дані та повертаємо результат
        return new BookResource((object)[
            'id' => 0,
            'name' => 'Neuromancer',
            'author' => 'William Gibson',
            'year' => 1984,
            'countPages' => 700,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(BookShowRequest $request): BookResource
    {
        $validatedData = $request->validated();
        //обробляємо отримані дані та повертаємо результат
        return new BookResource((object)[
            'id' => 0,
            'name' => 'Neuromancer',
            'author' => 'William Gibson',
            'year' => 1984,
            'countPages' => 700,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookUpdateRequest $request): BookResource
    {
        $validatedData = $request->validated();
        //обробляємо отримані дані та повертаємо результат
        return new BookResource((object)[
            'id' => 0,
            'name' => 'Neuromancer',
            'author' => 'William Gibson',
            'year' => 1984,
            'countPages' => 700,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookDestroyRequest $request): string
    {
        $validatedData = $request->validated();
        //обробляємо отримані дані та повертаємо результат в залежності від
        //результату видалення
        return 'Deleted';
    }
}
