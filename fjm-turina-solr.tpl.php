<?php

/**
* @file fjm-turina-solr.tpl.php
* Islandora solr search primary results template file
*
* Variables available:
* - $variables: all array elements of $variables can be used as a variable. e.g. $base_url equals $variables['base_url']
* - $base_url: The base url of the current website. eg: http://example.com .
* - $user: The user object.
*
* - $results: Primary profile results array
*/

?>

<!--
PID ~ PID
mods_title_mlt ~ Title 
mods_note_ms ~ Description
mods_genre_local_authority_ms ~ Genre
mods_name_personal_primary_ms ~ Author
mods_dateCreated_ms ~ Date

turina_thumbnail_s -> points to object with correct thumbnail
-->

<?php if (empty($results)): ?>
  <p class="no-results"><?php print t('Sorry, but your search returned no results.'); ?></p>
<?php else: ?>
  <!-- Ordered list -->
  <ol class="islandora-solr-search-results" start="<?php print $solr_start + 1 ?>">
    <?php $row_result = 0; ?>
    <?php foreach($results as $result): ?>
    <!-- add first/last classes + zebra -->
    <li class="<?php print $row_result % 2 == 0 ? 'odd' : 'even'; ?>">
      <!-- Result -->
      <div class="solr-result">
        <div class="solr-left">
          <!-- Title -->
          <?php if ($result['mods_title_mlt']['value']): ?>
            <div class="solr-label"><label><?php print $result['mods_title_mlt']['label']; ?>:</label></div>
            <div class="solr-value"><?php print l($result['mods_title_mlt']['value'], 'fedora/repository/' . $result['PID']['value'], array('attributes' => array('title' => $result['mods_title_mlt']['value']))); ?></div>
          <?php endif; ?>
          <!-- Description -->            
          <?php if ($result['mods_note_ms']['value']): ?>
            <div class="solr-label"><label><?php print $result['mods_note_ms']['label']; ?>:</label></div>
            <div class="solr-value"><?php print $result['mods_note_ms']['value']; ?></div>
          <?php endif; ?>
          <!-- Genre -->
          <?php if ($result['mods_genre_local_authority_ms']['value']): ?>
            <div class="solr-label"><label><?php print $result['mods_genre_local_authority_ms']['label']; ?>:</label></div>
            <div class="solr-value"><?php print $result['mods_genre_local_authority_ms']['value']; ?></div>
          <?php endif; ?>
          <!-- Author -->
          <?php if ($result['mods_name_personal_primary_ms']['value']): ?>
            <div class="solr-label"><label><?php print $result['mods_name_personal_primary_ms']['label']; ?>:</label></div>
            <div class="solr-value"><?php print $result['mods_name_personal_primary_ms']['value']; ?></div>
          <?php endif; ?>
          <!-- Date -->
          <?php if ($result['mods_dateCreated_ms']['value']): ?>
            <div class="solr-label"><label><?php print $result['mods_dateCreated_ms']['label']; ?>:</label></div>
            <div class="solr-value"><?php print $result['mods_dateCreated_ms']['value']; ?></div>
          <?php endif; ?>
        </div>
        <div class="solr-right">
          <!-- Thumbnail -->
          <?php $image = '<img src="' . $base_url . '/fedora/repository/' . $result['turina_thumbnail_s']['value'] . '/TN" />'; ?>
          <?php print l($image, 'fedora/repository/' . $result['PID']['value'], array('html' => TRUE, 'attributes' => array('title' => $result['mods_title_mlt']['value']))); ?>
        </div>
      </div>
    </li>
    <?php $row_result++; ?>
    <?php endforeach; ?>
  </ol>
<?php endif; ?>