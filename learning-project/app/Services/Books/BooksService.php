<?php

namespace App\Services\Books;

use App\Repositories\Books\BookIndexDTO;
use App\Repositories\Books\BookRepository;
use App\Repositories\Books\BookStoreDTO;
use App\Repositories\Books\BookUpdateDTO;
use App\Repositories\Books\iterators\BookIterator;
use Illuminate\Support\Collection;

class BooksService
{
    public function __construct(
        protected BookRepository $bookRepository
    ) {
    }

    public function store(BookStoreDTO $bookStoreDTO): BookIterator
    {
        $bookId = $this->bookRepository->store($bookStoreDTO);
        return $this->bookRepository->show($bookId);
    }

    public function show(int $id): BookIterator
    {
        return $this->bookRepository->show($id);
    }

    public function update(BookUpdateDTO $bookUpdateDTO): BookIterator
    {
        $this->bookRepository->update($bookUpdateDTO);
        return $this->bookRepository->show($bookUpdateDTO->getId());
    }

    public function destroy(int $id): int
    {
        return $this->bookRepository->destroy($id);
    }

    public function index(BookIndexDTO $bookIndexDTO): Collection
    {
        $data = $this->bookRepository->index($bookIndexDTO);
        return $data->map(function ($bookData) {
            return new BookIterator($bookData);
        });
    }
}
