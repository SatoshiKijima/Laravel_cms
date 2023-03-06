<script>
document.querySelector('.api-address').addEventListener('click', () => {
  const elem = document.querySelector('#zip');
  const zip = elem.value;
  fetch('../api/address/' + zip)
    .then((data) => data.json())
    .then((obj) => {
      if (!Object.keys(obj).length) {
        alert('住所が存在しません。');
      } else {
        document.querySelector('#pref').value = obj.pref;
        document.querySelector('#city').value = obj.city;
      }
    });
});
</script>