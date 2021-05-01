import { TestBed } from '@angular/core/testing';

import { AgronetService } from './agronet.service';

describe('AgronetService', () => {
  let service: AgronetService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(AgronetService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
