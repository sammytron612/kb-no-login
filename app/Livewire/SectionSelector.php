<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Section;
use Illuminate\Support\Collection;

class SectionSelector extends Component
{
    public $selectedSection = '';
    public $search = '';
    public $isOpen = false;
    public $sections;
    public $filteredSections;
    public $highlightedIndex = -1;
    public $name;
    public $required;
    public $placeholder;

    protected $listeners = ['clickAway' => 'closeDropdown'];

    public function mount($name = 'section', $selected = null, $required = false, $placeholder = 'Select a section...')
    {
        $this->name = $name;
        $this->selectedSection = $selected ?? old($name, '');
        $this->required = $required;
        $this->placeholder = $placeholder;
        $this->loadSections();

        // Set initial search value if section is already selected
        if ($this->selectedSection) {
            $this->setSearchFromSelected();
        }
    }

    public function loadSections()
    {
        $sections = Section::orderBy('parent')->orderBy('section')->get();
        $this->sections = collect($this->buildHierarchy($sections));
        $this->filteredSections = $this->sections;
    }

    private function buildHierarchy($sections, $parentId = 0, $level = 0)
    {
        $hierarchy = [];

        foreach ($sections as $section) {
            if ($section->parent == $parentId) {
                $section->level = $level;
                $section->indent = str_repeat('  ', $level);
                $section->icon = match($level) {
                    0 => '📁',
                    1 => '├─ 📂',
                    2 => '│  ├─ 📄',
                    3 => '│  │  ├─ 📋',
                    default => str_repeat('│  ', $level - 1) . '├─ 📎'
                };
                $hierarchy[] = $section;

                $children = $this->buildHierarchy($sections, $section->id, $level + 1);
                $hierarchy = array_merge($hierarchy, $children);
            }
        }

        return $hierarchy;
    }

    private function setSearchFromSelected()
    {
        if ($this->selectedSection && $this->sections) {
            $selectedSection = $this->sections->firstWhere('id', $this->selectedSection);
            $this->search = $selectedSection ? $selectedSection->section : '';
        }
    }

    public function updatedSearch()
    {
        $this->highlightedIndex = -1;

        if (empty($this->search)) {
            $this->filteredSections = $this->sections;
        } else {
            $this->filteredSections = $this->sections->filter(function ($section) {
                return stripos($section->section, $this->search) !== false;
            });
        }

        $this->isOpen = true;
    }

    public function selectSection($sectionId)
    {
        $selectedSection = $this->sections->firstWhere('id', $sectionId);

        if ($selectedSection) {
            $this->selectedSection = $sectionId;
            $this->search = $selectedSection->section;
            $this->isOpen = false;
            $this->highlightedIndex = -1;

            // Emit event for parent component
            $this->dispatch('sectionSelected', $sectionId);
        }
    }

    public function openDropdown()
    {
        $this->isOpen = true;
        $this->loadSections();
    }

    public function closeDropdown()
    {
        $this->isOpen = false;
        $this->highlightedIndex = -1;

        // Reset search to selected section name if one is selected
        $this->setSearchFromSelected();
    }

    public function clearSelection()
    {
        $this->selectedSection = '';
        $this->search = '';
        $this->filteredSections = $this->sections;
        $this->dispatch('sectionSelected', '');
    }

    public function handleKeydown($key)
    {
        if (!$this->isOpen) return;

        switch ($key) {
            case 'ArrowDown':
                $this->highlightedIndex = min($this->highlightedIndex + 1, $this->filteredSections->count() - 1);
                break;
            case 'ArrowUp':
                $this->highlightedIndex = max($this->highlightedIndex - 1, -1);
                break;
            case 'Enter':
                if ($this->highlightedIndex >= 0) {
                    $section = $this->filteredSections->values()[$this->highlightedIndex];
                    $this->selectSection($section->id);
                }
                break;
            case 'Escape':
                $this->closeDropdown();
                break;
        }
    }

    public function getSelectedSectionNameProperty()
    {
        if (!$this->selectedSection || !$this->sections) {
            return '';
        }

        $selectedSection = $this->sections->firstWhere('id', $this->selectedSection);
        return $selectedSection ? $selectedSection->section : '';
    }

    public function getSelectedSectionObjectProperty()
    {
        if (!$this->selectedSection || !$this->sections) {
            return null;
        }

        return $this->sections->firstWhere('id', $this->selectedSection);
    }

    public function render()
    {
        return view('livewire.section-selector');
    }
}
