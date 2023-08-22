<?php

namespace App\Controller;

use App\Entity\BorrowBook;
use App\Form\BorrowBookType;
use App\Repository\BorrowBookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/borrow/book")
 */
class BorrowBookController extends AbstractController
{
    /**
     * @Route("/", name="app_borrow_book_index", methods={"GET"})
     */
    public function index(BorrowBookRepository $borrowBookRepository): Response
    {
        return $this->render('borrow_book/index.html.twig', [
            'borrow_books' => $borrowBookRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_borrow_book_new", methods={"GET", "POST"})
     */
    public function new(Request $request, BorrowBookRepository $borrowBookRepository): Response
    {
        $borrowBook = new BorrowBook();
        $form = $this->createForm(BorrowBookType::class, $borrowBook);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $borrowBookRepository->add($borrowBook, true);

            return $this->redirectToRoute('app_borrow_book_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('borrow_book/new.html.twig', [
            'borrow_book' => $borrowBook,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_borrow_book_show", methods={"GET"})
     */
    public function show(BorrowBook $borrowBook): Response
    {
        return $this->render('borrow_book/show.html.twig', [
            'borrow_book' => $borrowBook,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_borrow_book_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, BorrowBook $borrowBook, BorrowBookRepository $borrowBookRepository): Response
    {
        $form = $this->createForm(BorrowBookType::class, $borrowBook);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $borrowBookRepository->add($borrowBook, true);

            return $this->redirectToRoute('app_borrow_book_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('borrow_book/edit.html.twig', [
            'borrow_book' => $borrowBook,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_borrow_book_delete", methods={"POST"})
     */
    public function delete(Request $request, BorrowBook $borrowBook, BorrowBookRepository $borrowBookRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$borrowBook->getId(), $request->request->get('_token'))) {
            $borrowBookRepository->remove($borrowBook, true);
        }

        return $this->redirectToRoute('app_borrow_book_index', [], Response::HTTP_SEE_OTHER);
    }
}
