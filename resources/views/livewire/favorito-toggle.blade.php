<div>
    <!-- Corazón arriba a la derecha -->
    <div class="position-absolute top-0 end-0 p-2 z-3">
        <button wire:click="toggle"
            class="border-0 bg-transparent p-0"
            style="font-size: 1.8rem;">
            {{ $esFavorito ? '❤️' : '🤍' }}
        </button>
    </div>

    <!-- Botón grande abajo -->
<!--    <div class="mt-5 w-100 px-3">
        <button wire:click="toggle"
            class="btn btn-outline-danger w-100"
            style="border-radius: 12px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
            ❤️ {{ $esFavorito ? 'Quitar de favoritos' : 'Añadir a favoritos' }}
        </button>
    </div>-->
</div>
