<?php if($paginator->hasPages()): ?>
<ul class="pagination" role="navigation">
    
    <?php if($paginator->onFirstPage()): ?>
        <li class="page-item disabled" aria-disabled="true" aria-label="<?php echo app('translator')->getFromJson('pagination.previous'); ?>">
            <span class="page-link" aria-hidden="true">&lsaquo;&lsaquo;</span>
        </li>
    <?php else: ?>
        <li class="page-item">
            <a class="page-link" href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev" aria-label="<?php echo app('translator')->getFromJson('pagination.previous'); ?>">&lsaquo;&lsaquo;</a>
        </li>
    <?php endif; ?>

    <?php
        $start = $paginator->currentPage() -1; // show 3 pagination links before current
        $end = $paginator->currentPage(); // show 3 pagination links after current
        if($start < 2) {
            $start = 2; // reset start to 1
            $end += 1;
        } 
        if($end >= $paginator->lastPage() ) $end = $paginator->lastPage(); // reset end to last page
    ?>

    <?php if($start > 1): ?>
        <li class="page-item">
            <a class="page-link" href="<?php echo e($paginator->url(1)); ?>"><?php echo e(1); ?></a>
        </li>
       
    <?php endif; ?>
        <?php for($i = $start; $i <= $end; $i++): ?>
            <li class="page-item <?php echo e(($paginator->currentPage() == $i) ? ' active' : ''); ?>">
                <a class="page-link" href="<?php echo e($paginator->url($i)); ?>"><?php echo e($i); ?></a>
            </li>
        <?php endfor; ?>
    <?php if($end < $paginator->lastPage()): ?>
        <?php if($paginator->currentPage() + 2 != $paginator->lastPage()): ?>
            
            <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
        <?php endif; ?>
        <li class="page-item">
            <a class="page-link" href="<?php echo e($paginator->url($paginator->lastPage())); ?>"><?php echo e($paginator->lastPage()); ?></a>
        </li>
    <?php endif; ?>

    
    <?php if($paginator->hasMorePages()): ?>
        <li class="page-item">
            <a class="page-link" href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next" aria-label="<?php echo app('translator')->getFromJson('pagination.next'); ?>">&rsaquo;&rsaquo;</a>
        </li>
    <?php else: ?>
        <li class="page-item disabled" aria-disabled="true" aria-label="<?php echo app('translator')->getFromJson('pagination.next'); ?>">
            <span class="page-link" aria-hidden="true">&lsaquo;&lsaquo;</span>
        </li>
    <?php endif; ?>
</ul>
<?php endif; ?>
