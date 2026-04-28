<script src="/assets/js/uploadImage.js" defer></script>

<div class="centerContainer">

    <a class="backBtn" href="/<?php echo $_SESSION['user']->access_level ?>"><i class="bi bi-arrow-90deg-left"></i></a>

      <div class="details">

        <div class="headerEdit">

            <h2 class="titleEdit">Adicione um novo produto</h2>      

        </div>

        <div class="form">

            <form enctype="multipart/form-data" action="/product/store" method="post">

                <label for="imagem" class="fileInput">
                    <div class="dropZone">
                        <p><b>Selecione uma imagem</b> ou solte aqui</p>
                    </div>
                    <input type="file" name="imagem" >
                </label>
                <?php echo flash('imagem'); ?>
                
                <label for="produto">Produto</label>
                <input type="text" name="produto" value="<?php echo old('produto'); ?>">
                <?php echo flash('produto'); ?>

                <label for="categoria">Categoria</label>

                <select name="categoria">
                    <option value="Alimentos e Bebidas">Alimentos e Bebidas</option>
                    <option value="Higiene e Limpeza">Higiene e Limpeza</option>
                    <option value="Eletrônicos">Eletrônicos</option>
                    <option value="Vestuário">Vestuário</option>
                    <option value="Móveis e Decoração">Móveis e Decoração</option>
                    <option value="Construção e Ferramentas">Construção e Ferramentas</option>
                    <option value="Farmácia e Saúde">Farmácia e Saúde</option>
                    <option value="Automotivo">Automotivo</option>
                </select>

                <label for="preco_compra">Preço de compra</label>
                <input type="number" name="preco_compra" step="0.01" value="<?php echo old('preco_compra'); ?>">
                <?php echo flash('preco_compra'); ?>

                <label for="preco_venda">Preço de Venda</label>
                <input type="number" name="preco_venda" step="0.01" value="<?php echo old('preco_venda'); ?>">
                <?php echo flash('preco_venda'); ?>

                <label for="estoque">Estoque</label>
                <input type="number" name="estoque" value="<?php echo old('estoque'); ?>">
                <?php echo flash('estoque'); ?>

                <label for="estoque_minimo">Estoque Mínimo</label>
                <input type="number" name="estoque_minimo" value="<?php echo old('estoque_minimo'); ?>">
                <?php echo flash('estoque_minimo'); ?>

                <label for="data_validade">Data de Validade</label>
                <input type="date" name="data_validade" value="<?php echo old('data_validade'); ?>">
                <?php echo flash('data_validade'); ?>

                <label for="lote">Lote</label>
                <input type="text" name="lote" value="<?php echo old('lote'); ?>">
                <?php echo flash('lote'); ?>

                <label for="unidade_medida">Unidade de Medida</label>
                <select name="unidade_medida">

                    <option value="nenhuma">Nenhuma</option> 
                    <option value="quilograma">Quilograma</option>
                    <option value="metro">Metro</option>
                    <option value="metro quadrado">Metro Quadrado</option>

                </select>         
                
                <label for="marca">Marca</label>
                <input type="text" name="marca" value="<?php echo old('marca'); ?>">
                <?php echo flash('marca'); ?>

                <div class="btnContainerColumn">
    
                    <button type="submit" id="btnEdit">Adicionar</button>
                    <a href="/<?php echo $_SESSION['user']->access_level ?>" class="redBtn" id="btnBack">Voltar</a>
                    
                </div>

            </form>

        </div>

    </div>

</div>
<?php echo alertMessages('product'); ?>  