<?php

namespace App\Repositories\Books;

use App\Repositories\Books\iterators\BookIterator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class BookRepository
{
    public function store(BookStoreDTO $bookStoreDTO): int
    {
        return DB::table('books')
            ->insertGetId([
                "name" => $bookStoreDTO->getName(),
                "year" => $bookStoreDTO->getYear(),
                "lang" => $bookStoreDTO->getLang(),
                "pages" => $bookStoreDTO->getPages(),
                "created_at" => NOW()
            ]);
    }

    public function show(int $id): BookIterator
    {
        return new BookIterator(DB::table('books')
            ->select([
                    "books.id",
                    "books.name",
                    "year",
                    "lang",
                    "pages",
                    "books.created_at",
                ]
            )
            ->where('books.id', '=', $id)
            ->first());
    }

    public function update(BookUpdateDTO $bookUpdateDTO): int
    {
        return DB::table('books')
            ->where('id', '=', $bookUpdateDTO->getId())
            ->update([
                "name" => $bookUpdateDTO->getName(),
                "year" => $bookUpdateDTO->getYear(),
                "lang" => $bookUpdateDTO->getLang(),
                "pages" => $bookUpdateDTO->getPages(),
            ]);
    }

    public function destroy(int $id): int
    {
        return DB::table('books')->delete($id);
    }

    public function index(BookIndexDTO $bookIndexDTO): Collection
    {
        $query = DB::table('books');

        $query->whereBetween('books.created_at', [$bookIndexDTO->getStartDate(), $bookIndexDTO->getEndDate()]);

//        $query->when($bookIndexDTO->getLang() !== null, function ($q) use ($bookIndexDTO) {
//            return $q->where('lang', '=', $bookIndexDTO->getLang());
//        });
//
//        $query->when($bookIndexDTO->getYear() !== null, function ($q) use ($bookIndexDTO) {
//            return $q->where('year', '=', $bookIndexDTO->getYear());
//        });
//
//        return collect($query->limit(100)->get());

        if (is_null($bookIndexDTO->getYear()) === false) {
            $query->where('year', '=', $bookIndexDTO->getYear());
        }

        if (is_null($bookIndexDTO->getLang()) === false) {
            $query->where('lang', '=', $bookIndexDTO->getLang());
        }

        $collection = $query->get();

        return $collection->map(function ($item) {
            return new BookIterator($item);
        });
    }
}
