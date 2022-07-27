<?php 
if(isset($_GET['term'])) {
    $term = urldecode($_GET['term']);
    
} else {
    $term = '';
    echo 'hello';
}
?>

<div class="search-content">
    <div class="search-container">
        <h1 class="search-heading">Search for a artist, album or song</h1>
        <input autofocus onkeyup="searchHandler(this)" type="text" class="search-input" data-search="input" onfocus="this.setSelectionRange(this.value.length,this.value.length);" value="<?php echo $term; ?>" placeholder="Search Here...">
    </div>
    
</div>

<script>
    document.querySelector('.search-container').addEventListener('click', (e) => {
        console.log(e)
    })
</script>

<!-- <script defer>
    let timer;
    console.log('hello search')
    const searchInput = document.querySelector("[data-search='input']")

    searchInput.addEventListener('keyup', ()=> {
        clearTimeout(timer);
        timer = setTimeout(()=> {
            const searchValue = searchInput.value
            openPage(`includes/html/searchContent.php?term=${searchValue}`)
        },2000)
    })
</script> -->


