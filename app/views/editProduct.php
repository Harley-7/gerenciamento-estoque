<script src="/assets/js/uploadImage.js" defer></script>

<div class="centerContainer">

    <div class="details">

        <div class="form">

            <div class="headerEdit">
                <h2 class="titleEdit">Editar dados da mercadoria</h2>       
            </div>

            <form enctype="multipart/form-data" action="/stock/update/id/<?php echo $id;?>" method="post">

                <label for="imagem" class="fileInput">
                    <div class="dropZone">
                        <p><b>Selecione uma imagem</b> ou solte aqui</p>
                    </div>
                    <input type="file" name="imagem" >
                </label>
                <?php echo flash('imagem'); ?>

                <label for="produto">Produto</label>
                <input type="text" name="produto" value="<?php echo $produto->produto; ?>">
                <?php echo flash('produto'); ?>

                <label for="categoria">Categoria</label>

                <select name="categoria">

                    <option <?php echo isSelected("Alimentos e Bebidas", $produto->categoria); ?> value="Alimentos e Bebidas">Alimentos e Bebidas</option>

                    <option <?php echo isSelected("Higiene e Limpeza", $produto->categoria); ?> value="Higiene e Limpeza">Higiene e Limpeza</option>

                    <option <?php echo isSelected("Eletrônicos", $produto->categoria); ?> value="Eletrônicos">Eletrônicos</option>

                    <option <?php echo isSelected("Vestuário", $produto->categoria); ?> value="Vestuário">Vestuário</option>

                    <option <?php echo isSelected("Móveis e Decoração", $produto->categoria); ?> value="Móveis e Decoração">Móveis e Decoração</option>

                    <option <?php echo isSelected("Construção e Ferramentas", $produto->categoria); ?> value="Construção e Ferramentas">Construção e Ferramentas</option>

                    <option <?php echo isSelected("Farmácia e Saúde", $produto->categoria); ?> value="Farmácia e Saúde">Farmácia e Saúde</option>

                    <option <?php echo isSelected("Automotivo", $produto->categoria); ?> value="Automotivo">Automotivo</option>

                </select>

                <label for="preco_compra">Preço de compra</label>
                <input type="number" name="preco_compra" step="0.01" value="<?php echo $produto->preco_compra; ?>">
                <?php echo flash('preco_compra'); ?>

                <label for="preco_venda">Preço de Venda</label>
                <input type="number" name="preco_venda" step="0.01" value="<?php echo $produto->preco_venda; ?>">
                <?php echo flash('preco_venda'); ?>

                <label for="estoque">Estoque</label>
                <input type="number" name="estoque" value="<?php echo $produto->estoque; ?>">
                <?php echo flash('estoque'); ?>

                <label for="estoque_minimo">Estoque Mínimo</label>
                <input type="number" name="estoque_minimo" value="<?php echo $produto->estoque_minimo; ?>">
                <?php echo flash('estoque_minimo'); ?>

                <label for="data_validade">Data de Validade</label>
                <input type="date" name="data_validade" value="<?php echo $produto->data_validade; ?>">
                <?php echo flash('data_validade'); ?>

                <label for="lote">Lote</label>
                <input type="text" name="lote" value="<?php echo $produto->lote; ?>">
                <?php echo flash('lote'); ?>

                <label for="unidade_medida">Unidade de Medida</label>
                <select name="unidade_medida">

                    <option <?php echo isSelected("nenhuma", $produto->unidade_medida); ?> value="nenhuma">Nenhuma</option>

                    <option <?php echo isSelected("quilograma", $produto->unidade_medida); ?> value="quilograma">Quilograma</option>

                    <option <?php echo isSelected("metro", $produto->unidade_medida); ?> value="metro">Metro</option>

                    <option <?php echo isSelected("metro quadrado", $produto->unidade_medida); ?> value="metro quadrado">Metro Quadrado</option>

                </select>         
                
                <label for="marca">Marca</label>
                <input type="text" name="marca" value="<?php echo $produto->marca; ?>">
                <?php echo flash('marca'); ?>

                <div class="btnContainerColumn">
                    <button type="submit" id="btnEdit">Editar</button>
                    <a href="/stock/details_product/id/<?php echo $produto->id; ?>" class="redBtn" id="btnBack">Voltar</a>
                </div>

            </form>

        </div>

    </div>

</div>

<?php echo alertMessages('productEdit'); ?> 