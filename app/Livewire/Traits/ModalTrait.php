<?php

namespace App\Livewire\Traits;

trait ModalTrait
{
    /**
     * Controls whether the modal is open or closed.
     */
    public bool $isOpen = false;

    /**
     * Open the modal.
     */
    public function openModal(): void
    {
        $this->isOpen = true;
    }

    /**
     * Close the modal.
     */
    public function closeModal(): void
    {
        $this->isOpen = false;
    }
} 