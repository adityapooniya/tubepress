<div class="wrap">
  <form method="post">
    <h2><?php echo ${org_tubepress_template_Template::OPTIONS_PAGE_TITLE}; ?></h2>
    <?php echo ${org_tubepress_template_Template::OPTIONS_PAGE_INTRO}; ?>
<br /><br />
    <div id="tubepress_tabs">
      <ul>
        <?php foreach (${org_tubepress_template_Template::OPTIONS_PAGE_CATEGORIES} as $optionCategoryName => $optionCategoryMetaArray): ?>
<li><a href="#<?php echo 'tubepress_' . md5($optionCategoryName); ?>"><span><?php echo $optionCategoryMetaArray[0]; ?></span></a></li>
        <?php endforeach; ?>

      </ul>

      <?php foreach (${org_tubepress_template_Template::OPTIONS_PAGE_CATEGORIES} as $optionCategoryName => $optionCategoryMetaArray): ?>

      <div id="<?php echo 'tubepress_' . md5($optionCategoryName); ?>">
        <table class="form-table" style="margin: 0">
        
          <?php if ($optionCategoryName != org_tubepress_options_Category::META): ?>
        
            <?php foreach ($optionCategoryMetaArray[1] as $optionArray): ?>
              
          <tr valign="top">
            <th style="border-bottom-style: none; font-size: 13px}" valign="top"><?php echo $optionArray[0]; ?><?php echo $optionArray[1]; ?></th>
            <td style="vertical-align: top; border-bottom-style: none"><?php echo $optionArray[2]; ?><br /><?php echo $optionArray[3]; ?></td>
          </tr>
            <?php endforeach; ?>
          
          <?php else: $index = 0; ?>
            <?php foreach ($optionCategoryMetaArray[1] as $optionArray): ?>
              <?php if ($index % 4 == 0): ?>
              
          <tr valign="top"><?php endif; ?>
                
            <td style="border-bottom-style: none; font-size: 13px}" valign="top"><?php echo $optionArray[2]; ?> <?php echo $optionArray[0]; ?></td>
              <?php if (++$index % 4 == 0): ?>
              
          </tr><?php endif; ?>
            <?php endforeach; ?>
          <?php endif; ?>
          
        </table>
      </div>

      <?php endforeach; ?>

    </div>
    <br />
    <input type="submit" name="tubepress_save" class="button-primary" value="<?php echo ${org_tubepress_template_Template::OPTIONS_PAGE_SAVE}; ?>" />
  </form><br />
  <?php echo ${org_tubepress_template_Template::OPTIONS_PAGE_DONATION}; ?>
  <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_s-xclick" />
    <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" />
    <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" />
    <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----" />
  </form>
</div>
<script type="text/javascript">jQuery(document).ready(function(){jQuery("#tubepress_tabs").tabs();});</script>