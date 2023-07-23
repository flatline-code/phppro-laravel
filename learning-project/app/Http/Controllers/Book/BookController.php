<?php

namespace App\Http\Controllers\Book;

use App\Enum\LangEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Book\BookDestroyRequest;
use App\Http\Requests\Book\BookIndexRequest;
use App\Http\Requests\Book\BookShowRequest;
use App\Http\Requests\Book\BookStoreRequest;
use App\Http\Requests\Book\BookUpdateRequest;
use App\Http\Resources\Book\BookResource;
use App\Repositories\Books\BookStoreDTO;
use App\Repositories\Books\BookUpdateDTO;
use App\Repositories\Books\BookIndexDTO;
use App\Services\Books\BooksService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookController extends Controller
{
    public function __construct(
        protected BooksService $booksService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(BookIndexRequest $request): AnonymousResourceCollection
    {
        $validatedData = $request->validated();
        return BookResource::collection(
            $this->booksService->index(
                new BookIndexDTO(
                    $validatedData['startDate'],
                    $validatedData['endDate'],
                    $validatedData['year'],
                    LangEnum::tryFrom($validatedData['lang']),
                )
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        BookStoreRequest $request
    ): JsonResponse
    {
        $validatedData = $request->validated();

        $dto = new BookStoreDTO(
            $validatedData['name'],
            $validatedData['year'],
            LangEnum::from($validatedData['lang']),
            $validatedData['pages'],
        );

        $iterator = $this->booksService->store($dto);

        return $this->getStoreResponse(
            new BookResource($iterator)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(BookShowRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $iterator = $this->booksService->show($validatedData['id']);

        return $this->getSuccessResponse(
            new BookResource($iterator)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookUpdateRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $dto = new BookUpdateDTO(
            $validatedData['id'],
            $validatedData['name'],
            $validatedData['year'],
            LangEnum::from($validatedData['lang']),
            $validatedData['pages'],
        );

        $iterator = $this->booksService->update($dto);

        return $this->getSuccessResponse(
            new BookResource($iterator)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookDestroyRequest $request): string
    {
        $validatedData = $request->validated();
        $this->booksService->destroy($validatedData['id']);
        return $this->getNoContentResponse();
    }
}
