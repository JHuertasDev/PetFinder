<section class="container-fluid bg-orange-dark ">
        <form id="petFilterForm" action="filtrar" method="get" class="row">
            <!-- City -->
            <div class="col-12 col-md-auto">
                <select id="inputCity" class="d-inline form-control mt-3" name="city">
                    <option value="none" selected disabled hidden>Ciudad</option>
                    {foreach from=$cities item=city}
                        <option value="{$city->id}">
                            {$city->name}
                        
                        </option>
                    {/foreach}
                </select>
            </div>
            <!-- Animal Type -->
            <div class="col-12 col-md-auto">
                <select id="inputAnimalType" class="d-inline form-control mt-3" name="animalType">
                    <option value="none" selected disabled hidden>Tipo de mascota</option>
                    {foreach from=$animaltypes item=animaltype}
                        <option value="{$animaltype->id}">{$animaltype->name}</option>
                    {/foreach}
                </select>
            </div>
            <!-- Gender -->
            <div class="col-12 col-md-auto">
                <select id="inputGender" class="d-inline form-control mt-3" name="gender">
                    <option value="none" selected disabled hidden>Género</option>
                    {foreach from=$genders item=gender}
                        <option value="{$gender->id}">{$gender->name}</option>
                    {/foreach}
                </select>
            </div>
            <!-- Filter -->
            <div class="col-12 col-md-auto d-flex justify-content-center mt-3 mt-md-0">
                <button type="submit" class="text-white d-inline btn bg-orange mt-md-3 mb-3">Filtrar</button>
            </div>
        </form>
    </section>