<div class="centerContainer">
    
    <a class="backBtn" href="/stock/details_product/id/<?php echo $produto->id ;?>"><i class="bi bi-arrow-90deg-left"></i></a>
    
    <div class="details">
        
        <div class="headerEdit">
            
            <h2 class="titleEdit">Reposição de estoque <?php echo $produto->produto; ?></h2>     
            
        </div>
        
        
        <div class="form">
            
            <form action="/product/replacement_update/<?php echo $produto->estoque; ?>/<?php echo $produto->id ?>" method="post">
                
                <label for="entry">Entrada</label>
                <input type="number" name="entry" id="entryInput" step="1">
                
                <div class="status">
                    <div>Estoque anterior: <span id="previousStockNum"><?php echo $produto->estoque; ?></span></div>
                    <div>Entrada: <span id="entryNum">+0</span></div>
                    <div>Estoque atualizado: <span id="updatedStockNum">0</span></div>
                </div>
                
                <button type="submit">Fazer reposição</button>
            </form>
            
        </div>
        
    </div>
    
</div>

<?php echo alertMessages("replacementStock"); ?>
<script src="/assets/js/replacementStock.js"></script>