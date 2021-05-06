import { ComponentFixture, TestBed } from '@angular/core/testing';

import { IniciologComponent } from './iniciolog.component';

describe('IniciologComponent', () => {
  let component: IniciologComponent;
  let fixture: ComponentFixture<IniciologComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ IniciologComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(IniciologComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
