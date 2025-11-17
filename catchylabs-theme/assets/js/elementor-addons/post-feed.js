document.addEventListener('DOMContentLoaded', function() {
    // Scroll to filters if they are active (URL has filter parameters)
    const urlParams = new URLSearchParams(window.location.search);
    const hasFilters = Array.from(urlParams.keys()).some(key => key.startsWith('filter_'));
    
    if (hasFilters) {
        const filterContainer = document.querySelector('.b3-posts .post-feed-filters');
        if (filterContainer) {
            // Small delay to ensure the page is fully loaded
            setTimeout(() => {
                filterContainer.scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'start' 
                });
            }, 100);
        }
    }

    // Get all the dropdown elements and buttons
    const dropdownToggles = document.querySelectorAll('.b3-posts .dropdown-toggle');
    const dropdownMenus = document.querySelectorAll('.b3-posts .dropdown-menu');
    const clearAllBtn = document.querySelector('.b3-posts .clear-all-btn');
    const filterForm = document.querySelector('.b3-posts .filter-form');

    // Custom dropdown functionality
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const targetId = this.getAttribute('data-target');
            const targetMenu = document.getElementById(targetId);
            
            // Close all other dropdowns
            dropdownMenus.forEach(menu => {
                if (menu.id !== targetId) {
                    menu.classList.remove('show');
                    menu.style.display = '';
                    const otherToggle = document.querySelector(`[data-target="${menu.id}"]`);
                    if (otherToggle) {
                        otherToggle.classList.remove('active');
                    }
                }
            });
            
            // Toggle current dropdown
            if (targetMenu) {
                const wasShown = targetMenu.classList.contains('show');
                
                if (wasShown) {
                    targetMenu.classList.remove('show');
                    targetMenu.style.display = '';
                    this.classList.remove('active');
                } else {
                    targetMenu.classList.add('show');
                    this.classList.add('active');
                    targetMenu.style.display = 'block';
                    targetMenu.style.visibility = 'visible';
                    targetMenu.style.opacity = '1';
                }
                
                // Ensure classes persist
                setTimeout(() => {
                    if (!wasShown && !targetMenu.classList.contains('show')) {
                        targetMenu.classList.add('show');
                        this.classList.add('active');
                        targetMenu.style.display = 'block';
                    }
                }, 10);
            }
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.b3-posts .custom-dropdown')) {
            dropdownMenus.forEach(menu => {
                menu.classList.remove('show');
            });
            dropdownToggles.forEach(toggle => {
                toggle.classList.remove('active');
            });
        }
    });

    // Prevent dropdown from closing when clicking inside
    dropdownMenus.forEach(menu => {
        menu.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });

    // Update dropdown appearance based on selections
    function updateDropdownAppearance(dropdown) {
        const toggle = dropdown.querySelector('.dropdown-toggle');
        const checkboxes = dropdown.querySelectorAll('input[type="checkbox"]');
        const label = toggle.querySelector('.dropdown-label');
        
        const checkedBoxes = Array.from(checkboxes).filter(cb => cb.checked);
        const originalText = label.getAttribute('data-original-text') || label.textContent;
        
        if (!label.getAttribute('data-original-text')) {
            label.setAttribute('data-original-text', originalText);
        }
        
        if (checkedBoxes.length > 0) {
            toggle.classList.add('has-selections');
            label.textContent = `${originalText} (${checkedBoxes.length})`;
        } else {
            toggle.classList.remove('has-selections');
            label.textContent = originalText;
        }
    }

    // Add change listeners to checkboxes
    document.querySelectorAll('.b3-posts .custom-dropdown input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const dropdown = this.closest('.custom-dropdown');
            updateDropdownAppearance(dropdown);
        });
    });

    // Initial update of dropdown appearances
    document.querySelectorAll('.b3-posts .custom-dropdown').forEach(dropdown => {
        updateDropdownAppearance(dropdown);
    });

    // Clear All button functionality
    if (clearAllBtn) {
        clearAllBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Clear all checkboxes
            document.querySelectorAll('.b3-posts .custom-dropdown input[type="checkbox"]').forEach(checkbox => {
                checkbox.checked = false;
            });
            
            // Update dropdown appearances
            document.querySelectorAll('.b3-posts .custom-dropdown').forEach(dropdown => {
                updateDropdownAppearance(dropdown);
            });
            
            // Close all dropdowns
            dropdownMenus.forEach(menu => {
                menu.classList.remove('show');
            });
            dropdownToggles.forEach(toggle => {
                toggle.classList.remove('active');
            });
            
            // Redirect to clear filters
            const currentUrl = window.location.href.split('?')[0];
            window.location.href = currentUrl;
        });
    }

    // Form submission - reset to page 1 when filters are applied
    if (filterForm) {
        filterForm.addEventListener('submit', function() {
            // Add hidden input to reset to page 1
            const pageInput = document.createElement('input');
            pageInput.type = 'hidden';
            pageInput.name = 'paged';
            pageInput.value = '1';
            this.appendChild(pageInput);
        });
    }

    // Keyboard navigation for dropdowns
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
            }
        });
    });

    // Keyboard navigation for checkboxes
    document.querySelectorAll('.b3-posts .checkbox-item').forEach(item => {
        item.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                const checkbox = this.querySelector('input[type="checkbox"]');
                if (checkbox) {
                    checkbox.checked = !checkbox.checked;
                    checkbox.dispatchEvent(new Event('change'));
                }
            }
        });
        
        // Make items focusable
        item.setAttribute('tabindex', '0');
    });
});
