<div class="authors_single">

    <table>
        <tr>
            <td width="120">Ім’я: </td>
            <td><?php echo $author->firstName.' '.$author->lastName.'<br>'; ?></td>
        </tr>
        <tr>
            <td>Роки життя: </td>
            <td><?php echo '('.$author->birthYear.' - '.$author->deathYear.')<br>'; ?></td>
        </tr>
        <tr>
            <td>Країна: </td>
            <td><?php echo $author->countryName.'<br>'; ?></td>
        </tr>
        <tr>
            <td>Біографія: </td>
            <td><?php echo $author->bio.'<br>'; ?></td>
        </tr>
    </table>


</div>