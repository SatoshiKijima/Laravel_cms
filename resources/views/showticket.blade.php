@vite(['resources/css/app.css', 'resources/js/app.js'])


<!-- モーダル用のHTML要素 -->
<div class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex justify-center items-center hidden" id="modal">
    <div class="ticket-container max-w-md bg-white rounded-lg shadow-lg">
        <div class="ticket-info p-4">
            <p class="font-bold">{{ $gift_sender }} さんからのみらいチケット(PokeGif)</p>
            <img src="{{ $image_url }}" alt="{{ $product_name }}" class="h-64 w-full object-cover rounded-lg shadow-lg mt-4">
            <p class="border-2 border-pink-500 p-4 my-4 break-all">応援メッセージ：<br>{{ $message }}</p>
            <p class="font-bold text-xl text-pink-500 mb-2">{{ $product_name }}</p>
            <p class="text-pink-500 text-xl mb-2">みらいチケット：{{ $price }}円</p>
            <p class="text-gray-500 limit-date">有効期限: 取得日から3カ月</p>
            <div class="flex justify-end mt-8">
                <button class="bg-pink-500 text-white font-bold py-2 px-4 rounded-full mr-4" id="close-modal-button">閉じる</button>
            </div>
        </div>
    </div>
</div>
<script>
    const openModalButtons = document.querySelectorAll('[data-modal-target]');
    const closeModalButton = document.getElementById('close-modal-button');
    const modal = document.getElementById('modal');

    openModalButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modalTarget = button.dataset.modalTarget;
            document.getElementById(modalTarget).classList.remove('hidden');
        });
    });

    closeModalButton.addEventListener('click', () => {
        modal.classList.add('hidden');
    });
</script>

