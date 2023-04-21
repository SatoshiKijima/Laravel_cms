@vite(['resources/css/app.css', 'resources/js/app.js'])


<!DOCTYPE html>
<html lang="ja">
  
<header>
  @include('components.userheader')
  <nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
      <div class="relative flex items-center justify-between h-16">
        <!-- ロゴ -->
        <!-- ナビゲーションメニュー -->
        <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
          <div class="sm:hidden">
            <button type="button" class="block text-gray-300 hover:text-white focus:text-white focus:outline-none" aria-expanded="false" aria-controls="mobile-menu" id="mobile-menu-button">
              <span class="sr-only">Toggle menu</span>
              <!-- このアイコンは好みに応じて変更してください -->
              <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                <path class="hidden" fill-rule="evenodd" clip-rule="evenodd" d="M3 6h18v2H3V6zm0 5h18v2H3v-2zm0 5h18v2H3v-2z"/>
                <path class="block" fill-rule="evenodd" clip-rule="evenodd" d="M4 6h16v2H4V6zm0 5h16v2H4v-2zm0 5h16v2H4v-2z"/>
              </svg>
            </button>
          </div>
          <div class="hidden sm:block sm:ml-6">
              <a href="/user/myticket" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">マイチケット</a>
              <a href="/user/tickets" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">みらいチケット掲示板</a>
              <a href="/user/home" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">マイページホーム</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- スマホ用メニュー -->
    <div class="sm:hidden" id="mobile-menu">
      <div class="px-2 pt-2 pb-3 space-y-1">
        <a href="/user/myticket" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">マイチケット</a>
         <a href="/user/tickets" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">みらいチケット掲示板</a>
         <a href="/user/home" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">マイページホーム</a>
        </div>
    </div>
  </nav>
</header>

 <script>
  const mobileMenuButton = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');

  mobileMenuButton.addEventListener('click', () => {
    const expanded = mobileMenuButton.getAttribute('aria-expanded') === 'true' || false;
    mobileMenuButton.setAttribute('aria-expanded', !expanded);
    mobileMenu.classList.toggle('hidden');
  });
</script> 





<section class="text-gray-600 body-font">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-col">
      <div class="h-1 bg-gray-200 rounded overflow-hidden">
        <div class="w-24 h-full bg-indigo-500"></div>
      </div>
      <div class="flex flex-wrap sm:flex-row flex-col py-6 mb-12">
        <h1 class="sm:w-2/5 text-gray-900 font-medium title-font text-2xl mb-2 sm:mb-0">未来を良くするための支援サイト<br>ポケットギフトのマイページです</h1>
        <p class="sm:w-3/5 leading-relaxed text-base sm:pl-10 pl-0">みらいチケットを介して、地域の大人が未来を子供たちを一緒に育て社会を良くする目的で行われている取り組みです。皆様の日々の生活を良くし、支援していただいた方にWebを通じてリアルタイムに匿名の形で支援のお礼が出来るのが特徴です。支援した方がサポートを受けた皆様の喜ぶメッセージが互いの支え合いの力となります。支援の見える化を互いにすることで新たな共生が社会を強くします。</p>
      </div>
    </div>
    <div class="flex flex-wrap sm:-m-4 -mx-4 -mb-10 -mt-4">
      <div class="p-4 md:w-1/3 sm:mb-0 mb-6">
        <div class="rounded-lg h-64 overflow-hidden">
          <img alt="content" class="object-cover object-center h-full w-full" src="{{ url('/storage/images/miraiticket.jpg') }}">
        </div>
        <h2 class="text-xl font-medium title-font text-gray-900 mt-5"><a href="/user/tickets">みらいチケット掲示板を見る</a></h2>
        <p class="text-base leading-relaxed mt-2">奈良県橿原市にある ”げんきカレー” さんの 『みらいチケット』 という取り組みをご存知でしょうか？カレーを食べに来たお客様がお支払い時に、追加で料金を支払うことで『みらいチケット』１枚が手渡されます。このチケットを店内のホワイトボードにメッセージと共に貼り付けます。すると、お腹を空かせた子ども達が、このチケットをつかって無料でカレーを食べることができます。地域の大人たちの 『お腹いっぱいたべて笑顔になってほしい』という善意が形になった素晴らしい取り組みです</p>
        <a class="text-indigo-500 inline-flex items-center mt-3">Learn More
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
            <path d="M5 12h14M12 5l7 7-7 7"></path>
          </svg>
        </a>
      </div>
      <div class="p-4 md:w-1/3 sm:mb-0 mb-6">
        <div class="rounded-lg h-64 overflow-hidden">
          <img alt="content" class="object-cover object-center h-full w-full" src="https://dummyimage.com/1204x504">
        </div>
        <h2 class="text-xl font-medium title-font text-gray-900 mt-5">The Catalyzer</h2>
        <p class="text-base leading-relaxed mt-2">Swag shoivdigoitch literally meditation subway tile tumblr cold-pressed. Gastropub street art beard dreamcatcher neutra, ethical XOXO lumbersexual.</p>
        <a class="text-indigo-500 inline-flex items-center mt-3">Learn More
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
            <path d="M5 12h14M12 5l7 7-7 7"></path>
          </svg>
        </a>
      </div>
      <div class="p-4 md:w-1/3 sm:mb-0 mb-6">
        <div class="rounded-lg h-64 overflow-hidden">
          <img alt="content" class="object-cover object-center h-full w-full" src="https://dummyimage.com/1205x505">
        </div>
        <h2 class="text-xl font-medium title-font text-gray-900 mt-5">The 400 Blows</h2>
        <p class="text-base leading-relaxed mt-2">Swag shoivdigoitch literally meditation subway tile tumblr cold-pressed. Gastropub street art beard dreamcatcher neutra, ethical XOXO lumbersexual.</p>
        <a class="text-indigo-500 inline-flex items-center mt-3">Learn More
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
            <path d="M5 12h14M12 5l7 7-7 7"></path>
          </svg>
        </a>
      </div>
    </div>
  </div>
</section>